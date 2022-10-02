<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Resize;

use Symfony\Component\Validator\Constraints as Assert;

final class PhotoResizeCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $fileId,
        #[Assert\NotBlank]
        public readonly string $apiKey,
    ) {
    }
}
