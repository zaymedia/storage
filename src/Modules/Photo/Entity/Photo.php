<?php

declare(strict_types=1);

namespace App\Modules\Photo\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Nonstandard\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'photo')]
class Photo
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 64, unique: true)]
    private string $fileId;

    #[ORM\Column(type: 'integer')]
    private int $type;

    #[ORM\Column(type: 'string', length: 255)]
    private string $host;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $hostS3;

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

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $sizes = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $cropSquare = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $cropCustom = null;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $isUse = false;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $resizeStatus = 0;

    #[ORM\Column(type: 'integer')]
    private int $createdAt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $updatedAt = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $deletedAt = null;

    private function __construct(
        int $type,
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
        $this->type = $type;
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
        int $type,
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
            type: $type,
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

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getFileId(): string
    {
        return $this->fileId;
    }

    public function setFileId(string $fileId): void
    {
        $this->fileId = $fileId;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    public function getHostS3(): ?string
    {
        return $this->hostS3;
    }

    public function setHostS3(?string $hostS3): void
    {
        $this->hostS3 = $hostS3;
    }

    public function getDir(): string
    {
        return $this->dir;
    }

    public function setDir(string $dir): void
    {
        $this->dir = $dir;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getExt(): string
    {
        return $this->ext;
    }

    public function setExt(string $ext): void
    {
        $this->ext = $ext;
    }

    public function getFields(): ?string
    {
        return $this->fields;
    }

    public function setFields(?string $fields): void
    {
        $this->fields = $fields;
    }

    public function getSize(): float|int
    {
        return $this->size;
    }

    public function setSize(float|int $size): void
    {
        $this->size = $size;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    public function getSizes(): array
    {
        return (\is_string($this->sizes)) ? (array)json_decode($this->sizes, true) : [];
    }

    public function setSizes(?array $sizes): void
    {
        $this->sizes = (\is_array($sizes)) ? json_encode($sizes) : null;
    }

    public function getCropSquare(): array
    {
        return (\is_string($this->cropSquare)) ? (array)json_decode($this->cropSquare, true) : [];
    }

    public function setCropSquare(?array $cropSquare): void
    {
        $this->cropSquare = (\is_array($cropSquare)) ? json_encode($cropSquare) : null;
    }

    public function getCropCustom(): array
    {
        return (\is_string($this->cropCustom)) ? (array)json_decode($this->cropCustom, true) : [];
    }

    public function setCropCustom(?array $cropCustom): void
    {
        $this->cropCustom = (\is_array($cropCustom)) ? json_encode($cropCustom) : null;
    }

    public function isUse(): bool
    {
        return $this->isUse;
    }

    public function setIsUse(bool $isUse): void
    {
        $this->isUse = $isUse;
    }

    public function getResizeStatus(): int
    {
        return $this->resizeStatus;
    }

    public function setResizeStatus(int $resizeStatus): void
    {
        $this->resizeStatus = $resizeStatus;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?int $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): ?int
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?int $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
