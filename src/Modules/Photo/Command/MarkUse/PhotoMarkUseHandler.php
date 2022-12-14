<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\MarkUse;

use App\Components\Flusher;
use App\Modules\Photo\Entity\PhotoRepository;

final class PhotoMarkUseHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(PhotoMarkUseCommand $command): void
    {
        $photo = $this->photoRepository->getByFileId($command->id);

        // todo

        $this->photoRepository->add($photo);
        $this->flusher->flush();
    }
}
