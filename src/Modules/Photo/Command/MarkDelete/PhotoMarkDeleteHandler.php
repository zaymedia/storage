<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\MarkDelete;

use App\Components\Flusher;
use App\Modules\Photo\Entity\PhotoRepository;

final class PhotoMarkDeleteHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(PhotoMarkDeleteCommand $command): void
    {
        $photo = $this->photoRepository->getByFileId($command->id);

        // todo

        $this->photoRepository->add($photo);
        $this->flusher->flush();
    }
}
