<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\CropSquare;

use Symfony\Component\Validator\Constraints as Assert;

final class PhotoCropSquareCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $fileId,
        #[Assert\NotBlank]
        public readonly string $secretKey,
        public readonly ?int $left = null,
        public readonly ?int $top = null,
        public readonly ?int $width = null,
    ) {
    }
}
