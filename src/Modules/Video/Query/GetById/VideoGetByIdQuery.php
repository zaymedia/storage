<?php

declare(strict_types=1);

namespace App\Modules\Video\Query\GetById;

use Symfony\Component\Validator\Constraints as Assert;

final class VideoGetByIdQuery
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $id,
    ) {
    }
}
