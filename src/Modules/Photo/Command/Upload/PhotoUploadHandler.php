<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Upload;

use App\Components\Flusher;
use App\Modules\Photo\Command\Optimize\PhotoOptimizeCommand;
use App\Modules\Photo\Command\Optimize\PhotoOptimizeHandler;
use App\Modules\Photo\Command\Processing\PhotoProcessingCommand;
use App\Modules\Photo\Command\Processing\PhotoProcessingHandler;
use App\Modules\Photo\Command\Upload\Result\PhotoUploadInfoResult;
use App\Modules\Photo\Command\Upload\Result\PhotoUploadMoveResult;
use App\Modules\Photo\Command\Upload\Result\PhotoUploadResult;
use App\Modules\Photo\Entity\Photo;
use App\Modules\Photo\Entity\PhotoRepository;
use App\Modules\System\Entity\PhotoType;
use App\Modules\System\Entity\PhotoTypeRepository;
use App\Modules\System\Entity\Settings;
use App\Modules\System\Entity\SettingsRepository;
use DomainException;
use Exception;
use getID3;
use Ramsey\Uuid\Uuid;

use function App\Components\env;

final class PhotoUploadHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly PhotoTypeRepository $photoTypeRepository,
        private readonly SettingsRepository $settingsRepository,
        private readonly PhotoOptimizeHandler $photoOptimizeHandler,
        private readonly PhotoProcessingHandler $photoProcessingHandler,
        private readonly Flusher $flusher,
        private readonly getID3 $getID3,
    ) {
    }

    public function handle(PhotoUploadCommand $command): PhotoUploadResult
    {
        $settings = $this->settingsRepository->getByPhoto();
        $photoType = $this->photoTypeRepository->getById($command->type);

        $fileInfo = $this->getFileInfo($settings, $photoType, $command->uploadFilePath, $command->queryParams);

        try {
            $file = $this->fileMove($settings, $command->uploadFilePath);
        } catch (Exception) {
            throw new DomainException('Fail file move!', 4);
        }

        $photo = Photo::create(
            type: $command->type,
            host: env('DOMAIN'),
            hostS3: null,
            dir: $file->dir,
            name: $file->name,
            ext: $fileInfo->ext,
            fields: $fileInfo->fields,
            size: $fileInfo->size,
            hash: $file->hash
        );

        $this->photoRepository->add($photo);
        $this->flusher->flush();

        $this->photoOptimizeHandler->handle(
            new PhotoOptimizeCommand(
                fileId: $photo->getFileId(),
                rotate: $command->rotate
            )
        );

        $processing = $this->photoProcessingHandler->handle(
            new PhotoProcessingCommand(
                fileId: $photo->getFileId(),
            )
        );

        $photo->setSizes($processing->sizes);
        $photo->setCropSquare($processing->cropSquare);
        $photo->setCropCustom($processing->cropCustom);

        $this->photoRepository->add($photo);
        $this->flusher->flush();

        return new PhotoUploadResult(
            host: env('SCHEME') . '://' . env('DOMAIN'),
            fileId: $photo->getFileId(),
        );
    }

    private function getPath(): string
    {
        return 'files/';
    }

    private function getFileInfo(
        Settings $settings,
        PhotoType $photoType,
        string $path,
        array $queryParams
    ): PhotoUploadInfoResult {
        if (empty($path)) {
            throw new DomainException('Fail file upload!', 3);
        }

        $fields = [];

        /** @var string $value */
        foreach ($photoType->getFields() as $value) {
            /** @var string[] $queryParams */
            if (!isset($queryParams[$value])) {
                throw new DomainException('Missing a required field!', 1);
            }
            $fields[$value] = $queryParams[$value];
        }

        // Get file info
        $imageInfo = $this->getID3->analyze($path);

        if (!isset($imageInfo['filesize']) || !isset($imageInfo['fileformat'])) {
            throw new DomainException('Fail file upload!', 3);
        }

        $size = (float)$imageInfo['filesize'];
        $ext = (string)$imageInfo['fileformat'];

        // Check min file size
        if ($size < $settings->getMinSize()) {
            throw new DomainException('Error min file size!', 5);
        }

        // Check max file size
        if ($settings->getMaxSize() < $size) {
            throw new DomainException('Error max file size!', 6);
        }

        // Check file type
        if (!\in_array($ext, $settings->getAllowTypes(), true)) {
            throw new DomainException('Error allow types!', 7);
        }

        return new PhotoUploadInfoResult(
            size: $size,
            ext: $ext,
            fields: $fields
        );
    }

    private function fileMove(
        Settings $settings,
        string $fileTempPath
    ): PhotoUploadMoveResult {
        $hash = hash_file('sha1', $fileTempPath);

        /** @var array{fileformat:string|null} $fileInfo */
        $fileInfo = $this->getID3->analyze($fileTempPath);

        if (!$extension = $fileInfo['fileformat'] ?? null) {
            throw new DomainException('Could not determine the file format!');
        }

        $level = (\strlen($hash) >= $settings->getLevel() * 2) ? $settings->getLevel() : 4;

        $month = floor(time() / 30 / 24 / 60 / 60);
        $_level = mb_substr($hash, 0, $level * 2, 'UTF-8');

        $basename = $month . \DIRECTORY_SEPARATOR . implode(\DIRECTORY_SEPARATOR, str_split($_level, 2)) . \DIRECTORY_SEPARATOR . str_replace($_level, '', $hash);

        $dir = $this->getPath() . $settings->getDir() . \DIRECTORY_SEPARATOR . $basename;

        if (!file_exists($dir)) {
            if (!mkdir($dir, 0755, true)) {
                throw new DomainException('Could not create dir!');
            }
        }

        for ($i = 0; $i <= 100; ++$i) {
            if ($i === 100) {
                throw new DomainException('More iterations!');
            }

            $filename = Uuid::uuid4()->toString();
            $path = $dir . \DIRECTORY_SEPARATOR . $filename . '.' . $extension;

            if (!file_exists($path)) {
                break;
            }
        }

        rename($fileTempPath, $path);

        return new PhotoUploadMoveResult(
            dir: $settings->getDir() . '/' . $basename . '/',
            name: $filename,
            hash: $hash
        );
    }
}
