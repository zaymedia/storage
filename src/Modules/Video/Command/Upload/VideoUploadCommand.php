<?php

declare(strict_types=1);

namespace App\Modules\Video\Command\Upload;

use Symfony\Component\Validator\Constraints as Assert;

final class VideoUploadCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly int $type,
        #[Assert\NotBlank]
        public readonly string $uploadFile,
    ) {
    }
}
