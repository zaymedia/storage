<?php

declare(strict_types=1);

namespace App\Modules\Audio\Command\MarkUse;

use Symfony\Component\Validator\Constraints as Assert;

final class AudioMarkUseCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $id,
        #[Assert\NotBlank]
        public readonly string $secretKey,
    ) {
    }
}
