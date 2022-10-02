<?php

declare(strict_types=1);

namespace App\Modules\System\Entity;

use Doctrine\ORM\Mapping as ORM;
use DomainException;

#[ORM\Entity]
#[ORM\Table(name: 'photo_type')]
class PhotoType
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $fields = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $sizes = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $cropSquareSizes = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $cropCustomSizes = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $cropCustomDefaultWidth = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $cropCustomDefaultHeight = null;

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

    public function getFields(): array
    {
        if ($this->fields === null) {
            return [];
        }

        return explode(',', $this->fields);
    }

    public function setFields(?string $fields): void
    {
        $this->fields = $fields;
    }

    /** @return int[] */
    public function getSizes(): array
    {
        $items = ($this->sizes !== null) ? explode(',', $this->sizes) : [];

        foreach ($items as $key => $value) {
            $items[$key] = (int)$value;
        }

        /** @var int[] $items */
        return $items;
    }

    public function setSizes(?string $sizes): void
    {
        $this->sizes = $sizes;
    }

    /** @return int[] */
    public function getCropSquareSizes(): array
    {
        $items = ($this->cropSquareSizes !== null) ? explode(',', $this->cropSquareSizes) : [];

        foreach ($items as $key => $value) {
            $items[$key] = (int)$value;
        }

        /** @var int[] $items */
        return $items;
    }

    public function setCropSquareSizes(?string $cropSquareSizes): void
    {
        $this->cropSquareSizes = $cropSquareSizes;
    }

    /** @return int[] */
    public function getCropCustomSizes(): array
    {
        $items = ($this->cropCustomSizes !== null) ? explode(',', $this->cropCustomSizes) : [];

        foreach ($items as $key => $value) {
            $items[$key] = (int)$value;
        }

        /** @var int[] $items */
        return $items;
    }

    public function setCropCustomSizes(?string $cropCustomSizes): void
    {
        $this->cropCustomSizes = $cropCustomSizes;
    }

    public function getCropCustomDefaultWidth(): ?int
    {
        return $this->cropCustomDefaultWidth;
    }

    public function setCropCustomDefaultWidth(?int $cropCustomDefaultWidth): void
    {
        $this->cropCustomDefaultWidth = $cropCustomDefaultWidth;
    }

    public function getCropCustomDefaultHeight(): ?int
    {
        return $this->cropCustomDefaultHeight;
    }

    public function setCropCustomDefaultHeight(?int $cropCustomDefaultHeight): void
    {
        $this->cropCustomDefaultHeight = $cropCustomDefaultHeight;
    }
}
