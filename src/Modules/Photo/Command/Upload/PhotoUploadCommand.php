<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Upload;

use Symfony\Component\Validator\Constraints as Assert;

final class PhotoUploadCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly int $type,
        public readonly ?int $rotate,
        public readonly ?int $left = null,
        public readonly ?int $top = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
    ) {
    }
}
