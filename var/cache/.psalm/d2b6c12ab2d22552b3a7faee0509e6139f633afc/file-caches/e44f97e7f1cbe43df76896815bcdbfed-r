<?php

declare(strict_types=1);

namespace App\Modules\Cover\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class CoverRepository
{
    /**
     * @var EntityRepository<Cover>
     */
    private EntityRepository $repo;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Cover::class);
        $this->em = $em;
    }

    public function getById(int $id): Cover
    {
        if (!$cover = $this->findById($id)) {
            throw new DomainException(
                message: 'error.cover.cover_not_found',
                code: 1
            );
        }

        return $cover;
    }

    public function findById(int $id): ?Cover
    {
        return $this->repo->findOneBy(['id' => $id]);
    }

    public function add(Cover $cover): void
    {
        $this->em->persist($cover);
    }

    public function remove(Cover $cover): void
    {
        $this->em->remove($cover);
    }
}
