<?php

declare(strict_types=1);

namespace App\Modules\Video\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'video')]
class Video
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $fileId;

    #[ORM\Column(type: 'integer')]
    private int $type;

    #[ORM\Column(type: 'string', length: 255)]
    private string $host;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $hostS3 = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $dir;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $ext;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $fields = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 7)]
    private float $size;

    #[ORM\Column(type: 'integer')]
    private int $duration;

    #[ORM\Column(type: 'string', length: 255)]
    private string $hash;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $sizes = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $coverDir = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $coverName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $coverExt = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?float $coverSize = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $coverSizes = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $coverCropSquare = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $coverCropCustom = null;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $isUse;

    #[ORM\Column(type: 'integer')]
    private int $createdAt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $updatedAt = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $deletedAt = null;

}
