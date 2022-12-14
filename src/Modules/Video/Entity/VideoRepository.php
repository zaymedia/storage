<?php

declare(strict_types=1);

namespace App\Modules\Video\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class VideoRepository
{
    /**
     * @var EntityRepository<Video>
     */
    private EntityRepository $repo;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Video::class);
        $this->em = $em;
    }

    public function getByFileId(string $fileId): Video
    {
        if (!$video = $this->findByFileId($fileId)) {
            throw new DomainException(
                message: 'error.video.video_not_found',
                code: 1
            );
        }

        return $video;
    }

    public function findByFileId(string $fileId): ?Video
    {
        return $this->repo->findOneBy(['fileId' => $fileId]);
    }

    public function add(Video $video): void
    {
        $this->em->persist($video);
    }

    public function remove(Video $video): void
    {
        $this->em->remove($video);
    }
}
