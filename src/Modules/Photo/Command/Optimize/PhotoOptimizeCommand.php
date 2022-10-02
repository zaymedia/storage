<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Optimize;

use Symfony\Component\Validator\Constraints as Assert;

final class PhotoOptimizeCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $fileId,
        public readonly ?int $rotate,
    ) {
    }
}
