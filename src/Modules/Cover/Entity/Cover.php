<?php

declare(strict_types=1);

namespace App\Modules\Cover\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Nonstandard\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'cover')]
class Cover
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 64, unique: true)]
    private string $fileId;

    #[ORM\Column(type: 'integer')]
    private int $mediaType;

    #[ORM\Column(type: 'string', length: 255)]
    private string $host;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $hostS3 = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $dir;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 20)]
    private string $ext;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $fields;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 2)]
    private float $size;

    #[ORM\Column(type: 'string', length: 255)]
    private string $hash;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $sizes = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $cropSquare = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $cropCustom = null;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $resizeStatus = 0;

    #[ORM\Column(type: 'integer')]
    private int $createdAt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $updatedAt = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $deletedAt = null;

    private function __construct(
        int $mediaType,
        string $host,
        ?string $hostS3,
        string $dir,
        string $name,
        string $ext,
        array $fields,
        float $size,
        string $hash,
    ) {
        $this->fileId = Uuid::uuid4()->toString();
        $this->mediaType = $mediaType;
        $this->host = $host;
        $this->hostS3 = $hostS3;
        $this->dir = $dir;
        $this->name = $name;
        $this->ext = $ext;
        /** @var string[] $fields */
        $this->fields = implode(',', $fields);
        $this->size = $size;
        $this->hash = $hash;
        $this->createdAt = time();
    }

    public static function create(
        int $mediaType,
        string $host,
        ?string $hostS3,
        string $dir,
        string $name,
        string $ext,
        array $fields,
        float $size,
        string $hash,
    ): self {
        return new self(
            mediaType: $mediaType,
            host: $host,
            hostS3: $hostS3,
            dir: $dir,
            name: $name,
            ext: $ext,
            fields: $fields,
            size: $size,
            hash: $hash,
        );
    }
}
