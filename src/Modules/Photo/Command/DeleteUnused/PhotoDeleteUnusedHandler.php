<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\DeleteUnused;

use App\Components\Flusher;
use App\Modules\Photo\Entity\PhotoRepository;

final class PhotoDeleteUnusedHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(): void
    {
        // todo
    }
}
