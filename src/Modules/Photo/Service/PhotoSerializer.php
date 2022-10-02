<?php

declare(strict_types=1);

namespace App\Modules\Photo\Service;

use function App\Components\env;

class PhotoSerializer
{
    public function serialize(?array $photo): ?array
    {
        /** @var array{
         *     file_id: string,
         *     host: string,
         *     host_s3: string,
         *     sizes: string,
         *     crop_square: string,
         *     crop_custom: string,
         *     fields: string,
         *     dir: string,
         *     name: string,
         *     ext: string,
         *     type: int,
         *     hash: string,
         *     size: float,
         *     created_at: int,
         *     updated_at: int|null,
         *     is_use: int,
         * }|null $photo
         */
        if (empty($photo)) {
            return null;
        }

        $time = time();
        $mark = ($photo['updated_at'] !== null) ? '?t=' . $time : '';

        $host   = (!empty($photo['host_s3'])) ? $photo['host_s3'] : $photo['host'];
        $scheme = (!empty($photo['host_s3'])) ? 'https' : env('SCHEME');

        // File sizes
        $sizes = (!empty($photo['sizes'])) ? (array)json_decode($photo['sizes'], true) : [];

        /**
         * @var int $key
         * @var string $value
         */
        foreach ($sizes as $key => $value) {
            $sizes[$key] = $scheme . '://' . $host . '/' . $value . $mark;
        }

        // File crop square
        $crop_square = (!empty($photo['crop_square'])) ? (array)json_decode($photo['crop_square'], true) : [];

        /**
         * @var int $key
         * @var string $value
         */
        foreach ($crop_square as $key => $value) {
            $crop_square[$key] = $scheme . '://' . $host . '/' . $value . $mark;
        }

        // File crop custom
        $crop_custom = (!empty($photo['crop_custom'])) ? (array)json_decode($photo['crop_custom'], true) : [];

        /**
         * @var int $key
         * @var string $value
         */
        foreach ($crop_custom as $key => $value) {
            $crop_custom[$key] = $scheme . '://' . $host . '/' . $value . $mark;
        }

        return [
            'file_id'       => $photo['file_id'],
            'fields'        => (!empty($photo['fields'])) ? json_decode($photo['fields'], true) : null,
            'original'      => $scheme . '://' . $host . '/files/' . $photo['dir'] . $photo['name'] . '.' . $photo['ext'],
            'sizes'         => (!empty($sizes)) ? $sizes : null,
            'crop_square'   => (!empty($crop_square)) ? $crop_square : null,
            'crop_custom'   => (!empty($crop_custom)) ? $crop_custom : null,
            'type'          => $photo['type'],
            'hash'          => $photo['hash'],
            'size'          => $photo['size'],
            'created_at'    => $photo['created_at'],
            'updated_at'    => $photo['updated_at'],
            'is_use'        => $photo['is_use'],
        ];
    }
}
