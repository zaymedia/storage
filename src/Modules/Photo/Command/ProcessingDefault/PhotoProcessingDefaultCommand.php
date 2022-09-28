<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\ProcessingDefault;

use Symfony\Component\Validator\Constraints as Assert;

final class PhotoProcessingDefaultCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $fileId,
        #[Assert\NotBlank]
        public readonly string $secretKey,
    ) {
    }
}
