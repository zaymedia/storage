<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Optimize;

use api\classes\Imager;
use App\Modules\Photo\Entity\PhotoRepository;
use App\Modules\System\Entity\SettingsRepository;
use DomainException;

final class PhotoOptimizeHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly SettingsRepository $settingsRepository,
        private readonly Imager $imager,
        private readonly int $quality = 90,
    ) {
    }

    public function handle(PhotoOptimizeCommand $command): void
    {
        $settings = $this->settingsRepository->getByPhoto();
        $photo = $this->photoRepository->getByFileId($command->fileId);

        if ($settings->getMinSize() < $photo->getSize()) {
            return;
        }

        $path = $this->getPath() . $photo->getDir() . $photo->getName() . '.' . $photo->getExt();

        if (!$this->imager->optimize($path, $this->quality, $command->rotate)) {
            throw new DomainException('Error optimize file!', 8);
        }
    }

    private function getPath(): string
    {
        return 'files/';
    }
}
