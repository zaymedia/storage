<?php

declare(strict_types=1);

namespace App\Modules\Video\Command\MarkDelete;

use Symfony\Component\Validator\Constraints as Assert;

final class VideoMarkDeleteCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $id,
        #[Assert\NotBlank]
        public readonly string $apiKey,
    ) {
    }
}
