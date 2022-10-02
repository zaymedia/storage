<?php

declare(strict_types=1);

namespace App\Modules\Audio\Query\GetById;

use Symfony\Component\Validator\Constraints as Assert;

final class AudioGetByIdQuery
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $id,
    ) {
    }
}
