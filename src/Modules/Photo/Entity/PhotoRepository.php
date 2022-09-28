<?php

declare(strict_types=1);

namespace App\Modules\Photo\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class PhotoRepository
{
    /**
     * @var EntityRepository<Photo>
     */
    private EntityRepository $repo;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Photo::class);
        $this->em = $em;
    }

    public function getById(int $id): Photo
    {
        if (!$photo = $this->findById($id)) {
            throw new DomainException(
                message: 'error.photo.photo_not_found',
                code: 1
            );
        }

        return $photo;
    }

    public function findById(int $id): ?Photo
    {
        return $this->repo->findOneBy(['id' => $id]);
    }

    public function add(Photo $photo): void
    {
        $this->em->persist($photo);
    }

    public function remove(Photo $photo): void
    {
        $this->em->remove($photo);
    }
}
