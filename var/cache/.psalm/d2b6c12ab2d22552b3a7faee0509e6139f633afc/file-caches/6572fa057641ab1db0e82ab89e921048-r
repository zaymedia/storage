<?php

declare(strict_types=1);

namespace App\Modules\Video\Service;

class VideoSerializer
{
    public function serialize(?array $video): ?array
    {
        if (empty($video)) {
            return null;
        }

        return [
            'id'            => $video['id'],
            'albumId'       => $video['album_id'],
            'userId'        => $video['user_id'],
        ];
    }
}
