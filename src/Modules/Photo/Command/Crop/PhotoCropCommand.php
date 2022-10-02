<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Crop;

use Symfony\Component\Validator\Constraints as Assert;

final class PhotoCropCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $fileId,
        #[Assert\NotBlank]
        public readonly string $apiKey,
        public readonly ?int $left = null,
        public readonly ?int $top = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
    ) {
    }
}
