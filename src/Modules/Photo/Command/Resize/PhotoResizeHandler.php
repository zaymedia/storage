<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Resize;

use App\Components\Flusher;
use App\Modules\Photo\Entity\PhotoRepository;

final class PhotoResizeHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(PhotoResizeCommand $command): void
    {
        $photo = $this->photoRepository->getByFileId($command->fileId);

        // todo

        $this->photoRepository->add($photo);
        $this->flusher->flush();
    }
}
