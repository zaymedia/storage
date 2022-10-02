<?php

declare(strict_types=1);

namespace App\Modules\System\Entity;

use Doctrine\ORM\Mapping as ORM;
use DomainException;

#[ORM\Entity]
#[ORM\Table(name: 'settings')]
class Settings
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private string $type;

    #[ORM\Column(type: 'string', length: 500)]
    private string $dir;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $dirCover = null;

    #[ORM\Column(type: 'integer')]
    private int $level;

    #[ORM\Column(type: 'string', length: 500)]
    private string $allowTypes;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $minSizeOptimize;

    #[ORM\Column(type: 'integer')]
    private int $minSize;

    #[ORM\Column(type: 'integer')]
    private int $maxSize;

    #[ORM\Column(type: 'integer')]
    private int $timeStorageNoUse;

    #[ORM\Column(type: 'integer')]
    private int $timeStorageDelete;

    public function __construct(
        string $type,
        string $dir,
        ?string $dirCover,
        int $level,
        string $allowTypes,
        ?int $minSizeOptimize,
        int $minSize,
        int $maxSize,
        int $timeStorageNoUse,
        int $timeStorageDelete
    ) {
        $this->type = $type;
        $this->dir = $dir;
        $this->dirCover = $dirCover;
        $this->level = $level;
        $this->allowTypes = $allowTypes;
        $this->minSizeOptimize = $minSizeOptimize;
        $this->minSize = $minSize;
        $this->maxSize = $maxSize;
        $this->timeStorageNoUse = $timeStorageNoUse;
        $this->timeStorageDelete = $timeStorageDelete;
    }

    public function getId(): int
    {
        if (null === $this->id) {
            throw new DomainException('Id not set');
        }
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getDir(): string
    {
        return $this->dir;
    }

    public function setDir(string $dir): void
    {
        $this->dir = $dir;
    }

    public function getDirCover(): ?string
    {
        return $this->dirCover;
    }

    public function setDirCover(?string $dirCover): void
    {
        $this->dirCover = $dirCover;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getAllowTypes(): array
    {
        return explode(',', $this->allowTypes);
    }

    public function setAllowTypes(string $allowTypes): void
    {
        $this->allowTypes = $allowTypes;
    }

    public function getMinSizeOptimize(): ?int
    {
        return $this->minSizeOptimize;
    }

    public function setMinSizeOptimize(?int $minSizeOptimize): void
    {
        $this->minSizeOptimize = $minSizeOptimize;
    }

    public function getMinSize(): int
    {
        return $this->minSize;
    }

    public function setMinSize(int $minSize): void
    {
        $this->minSize = $minSize;
    }

    public function getMaxSize(): int
    {
        return $this->maxSize;
    }

    public function setMaxSize(int $maxSize): void
    {
        $this->maxSize = $maxSize;
    }

    public function getTimeStorageNoUse(): int
    {
        return $this->timeStorageNoUse;
    }

    public function setTimeStorageNoUse(int $timeStorageNoUse): void
    {
        $this->timeStorageNoUse = $timeStorageNoUse;
    }

    public function getTimeStorageDelete(): int
    {
        return $this->timeStorageDelete;
    }

    public function setTimeStorageDelete(int $timeStorageDelete): void
    {
        $this->timeStorageDelete = $timeStorageDelete;
    }
}
