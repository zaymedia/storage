<?php

declare(strict_types=1);

namespace App\Modules\Video\Command\DeleteUnused;

use App\Components\Flusher;
use App\Modules\Video\Entity\VideoRepository;

final class VideoDeleteUnusedHandler
{
    public function __construct(
        private readonly VideoRepository $videoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(): void
    {
        // todo
    }
}
