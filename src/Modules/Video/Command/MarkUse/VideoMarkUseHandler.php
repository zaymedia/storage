<?php

declare(strict_types=1);

namespace App\Modules\Video\Command\MarkUse;

use App\Components\Flusher;
use App\Modules\Video\Entity\VideoRepository;

final class VideoMarkUseHandler
{
    public function __construct(
        private readonly VideoRepository $videoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(VideoMarkUseCommand $command): void
    {
        $photo = $this->videoRepository->getById($command->id);

        // todo

        $this->videoRepository->add($photo);
        $this->flusher->flush();
    }
}
