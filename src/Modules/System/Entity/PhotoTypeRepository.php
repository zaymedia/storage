<?php

declare(strict_types=1);

namespace App\Modules\System\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class PhotoTypeRepository
{
    /**
     * @var EntityRepository<PhotoType>
     */
    private EntityRepository $repo;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(PhotoType::class);
        $this->em = $em;
    }

    public function getById(int $id): PhotoType
    {
        if (!$photoType = $this->findById($id)) {
            throw new DomainException(
                message: 'Type not found!',
                code: 1
            );
        }

        return $photoType;
    }

    public function findById(int $id): ?PhotoType
    {
        return $this->repo->findOneBy(['id' => $id]);
    }

    public function add(PhotoType $photoType): void
    {
        $this->em->persist($photoType);
    }

    public function remove(PhotoType $photoType): void
    {
        $this->em->remove($photoType);
    }
}
