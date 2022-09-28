<?php

declare(strict_types=1);

namespace App\Modules\Video\Command\MarkDelete;

use App\Components\Flusher;
use App\Modules\Video\Entity\VideoRepository;

final class VideoMarkDeleteHandler
{
    public function __construct(
        private readonly VideoRepository $videoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(VideoMarkDeleteCommand $command): void
    {
        $photo = $this->videoRepository->getById($command->id);

        // todo

        $this->videoRepository->add($photo);
        $this->flusher->flush();
    }
}
