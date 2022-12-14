<?php

declare(strict_types=1);

namespace App\Modules\Video\Command\MarkUse;

use Symfony\Component\Validator\Constraints as Assert;

final class VideoMarkUseCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $id,
        #[Assert\NotBlank]
        public readonly string $apiKey,
    ) {
    }
}
