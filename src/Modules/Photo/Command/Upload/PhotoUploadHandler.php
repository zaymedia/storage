<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Upload;

use App\Components\Flusher;
use App\Modules\Photo\Entity\PhotoRepository;

final class PhotoUploadHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(PhotoUploadCommand $command): void
    {
        $photo = $this->photoRepository->getById($command->fileId);

        // todo

        $this->photoRepository->add($photo);
        $this->flusher->flush();
    }
}
