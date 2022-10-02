<?php

declare(strict_types=1);

namespace App\Modules\Audio\Service;

class AudioSerializer
{
    public function serialize(?array $audio): ?array
    {
        if (empty($audio)) {
            return null;
        }

        return [
            'id'            => $audio['id'],
            'albumId'       => $audio['album_id'],
            'userId'        => $audio['user_id'],
        ];
    }
}
