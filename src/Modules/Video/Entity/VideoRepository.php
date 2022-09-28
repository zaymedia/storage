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

    public function getById(int $id): Video
    {
        if (!$video = $this->findById($id)) {
            throw new DomainException(
                message: 'error.video.video_not_found',
                code: 1
            );
        }

        return $video;
    }

    public function findById(int $id): ?Video
    {
        return $this->repo->findOneBy(['id' => $id]);
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
