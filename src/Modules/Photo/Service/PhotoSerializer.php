<?php

declare(strict_types=1);

namespace App\Modules\Photo\Service;

class PhotoSerializer
{
    public function serialize(?array $photo): ?array
    {
        if (empty($photo)) {
            return null;
        }

        return [
            'id'            => $photo['id'],
            'fileId'       => $photo['file_id'],
        ];
    }
}
