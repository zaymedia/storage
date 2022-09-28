<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\ProcessingDefault;

use App\Components\Flusher;
use App\Modules\Photo\Entity\PhotoRepository;

final class PhotoProcessingDefaultHandler
{
    public function __construct(
        private readonly PhotoRepository $photoRepository,
        private readonly Flusher $flusher
    ) {
    }

    public function handle(PhotoProcessingDefaultCommand $command): void
    {
        // todo
    }
}
