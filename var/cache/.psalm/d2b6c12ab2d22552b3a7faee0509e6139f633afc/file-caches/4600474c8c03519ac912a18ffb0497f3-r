<?php

declare(strict_types=1);

namespace App\Modules\Photo\Command\Processing;

use Symfony\Component\Validator\Constraints as Assert;

final class PhotoProcessingCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $fileId,
    ) {
    }
}
