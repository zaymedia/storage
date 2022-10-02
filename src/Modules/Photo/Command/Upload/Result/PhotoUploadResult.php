<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Upload\Result;

final class PhotoUploadResult
{
    public function __construct(
        public readonly string $host,
        public readonly string $fileId
    ) {
    }
}
