<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Upload\Result;

final class PhotoUploadMoveResult
{
    public function __construct(
        public readonly string $dir,
        public readonly string $name,
        public readonly string $hash,
    ) {
    }
}
