<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Crop;

use App\Components\Flusher;
use App\Modules\Photo\Entity\PhotoRepository;

final class PhotoCropHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(PhotoCropCommand $command): void
    {
        $photo = $this->photoRepository->getById($command->fileId);

        // todo

        $this->photoRepository->add($photo);
        $this->flusher->flush();
    }
}
