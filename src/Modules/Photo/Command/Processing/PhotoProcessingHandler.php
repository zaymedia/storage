<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Processing;

use api\classes\Imager;
use App\Modules\Photo\Command\Upload\Result\PhotoUploadSizesResult;
use App\Modules\Photo\Entity\PhotoRepository;
use App\Modules\System\Entity\PhotoType;
use App\Modules\System\Entity\PhotoTypeRepository;

final class PhotoProcessingHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly PhotoTypeRepository $photoTypeRepository,
        private readonly Imager $imager,
        private readonly int $quality = 90,
    ) {
    }

    public function handle(PhotoProcessingCommand $command): PhotoUploadSizesResult
    {
        $photo = $this->photoRepository->getByFileId($command->fileId);
        $photoType = $this->photoTypeRepository->getById($photo->getType());

        $path = $this->getPath() . $photo->getDir() . $photo->getName() . '.' . $photo->getExt();

        $params = [];

        return new PhotoUploadSizesResult(
            sizes: $this->resizeBySettings($photoType, $path, $this->quality, $photo->getSizes()),
            cropSquare: $this->cropSquare($photoType, $path, $params, $this->quality, $photo->getCropSquare()),
            cropCustom: $this->cropCustom($photoType, $path, $params, $this->quality, $photo->getCropCustom())
        );
    }

    private function getPath(): string
    {
        return 'files/';
    }

    private function resizeBySettings(PhotoType $photoType, string $path, int $quality, array $files): ?array
    {
        if (empty($photoType->getSizes())) {
            $this->fileDeleteOld($files);
            return null;
        }

        $result = [];

        // Resize
        foreach ($photoType->getSizes() as $width) {
            $result[$width] = $this->fileResize($path, $width, $quality);
        }

        // Delete old files
        if (!empty($files)) {
            /** @var string[] $files */
            foreach ($files as $item) {
                if (!\in_array($item, $result, true)) {
                    $this->fileDeleteOld([$item]);
                }
            }
        }

        ksort($result);

        return $result;
    }

    private function cropSquare(
        PhotoType $photoType,
        string $path,
        array $params = null,
        int $quality = null,
        array $files = []
    ): ?array {
        if (empty($photoType->getCropSquareSizes())) {
            $this->fileDeleteOld($files);
            return null;
        }

        if (!$path = $this->fileCropSquare($path, $params, $quality)) {
            return null;
        }

        $result = [];

        // Resize
        foreach ($photoType->getCropSquareSizes() as $width) {
            $result[$width] = $this->fileResize($path, $width, $quality, 's');
        }

        // Delete max crop file
        $this->fileDeleteOld([$path]);

        // Delete old files
        if (!empty($files)) {
            /** @var string[] $files */
            foreach ($files as $item) {
                if (!\in_array($item, $result, true)) {
                    $this->fileDeleteOld([$item]);
                }
            }
        }

        ksort($result);

        return $result;
    }

    private function cropCustom(
        PhotoType $photoType,
        string $path,
        array $params = null,
        int $quality = null,
        array $files = []
    ): ?array {
        if (
            empty($photoType->getCropCustomSizes()) ||
            empty($photoType->getCropCustomDefaultHeight()) ||
                empty($photoType->getCropCustomDefaultWidth())
        ) {
            $this->fileDeleteOld($files);
            return null;
        }

        $defaultParams = [
            'width'  => $photoType->getCropCustomDefaultWidth(),
            'height' => $photoType->getCropCustomDefaultHeight(),
        ];

        if (!$path = $this->fileCrop($path, $defaultParams, $params, $quality)) {
            return null;
        }

        $result = [];

        // Resize
        foreach ($photoType->getCropCustomSizes() as $width) {
            $result[$width] = $this->fileResize($path, $width, $quality, 'c');
        }

        // Delete max crop file
        $this->fileDeleteOld([$path]);

        // Delete old files
        if (!empty($files)) {
            /** @var string[] $files */
            foreach ($files as $item) {
                if (!\in_array($item, $result, true)) {
                    $this->fileDeleteOld([$item]);
                }
            }
        }

        ksort($result);

        return $result;
    }

    private function fileResize(string $path, int $width, int $quality = null, string $prefix = null): string
    {
        $resize_path = $this->imager->resize($path, $width, $quality, $prefix);

        return Imager::withoutRootDir('', ($resize_path) ?: $path);
    }

    private function fileCrop(string $path, array $defaultParams = null, array $params = null, int $quality = null): ?string
    {
        if ($path = $this->imager->crop($path, $defaultParams, $params, $quality)) {
            return Imager::withoutRootDir('', $path);
        }

        return null;
    }

    private function fileCropSquare(string $path, array $params = null, int $quality = null): ?string
    {
        if ($path = $this->imager->cropSquare($path, $params, $quality)) {
            return Imager::withoutRootDir('', $path);
        }

        return null;
    }

    private function fileDeleteOld(array $files): void
    {
        /** @var string[] $files */
        foreach ($files as $path) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
}
