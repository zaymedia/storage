<?php

declare(strict_types=1);

namespace App\Modules\Photo\Query\GetById;

use Symfony\Component\Validator\Constraints as Assert;

final class PhotoGetByIdQuery
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $id,
        #[Assert\NotBlank]
        public readonly string $secretKey,
    ) {
    }
}
