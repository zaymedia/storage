<?php

declare(strict_types=1);

namespace App\Modules\Audio\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class AudioRepository
{
    /**
     * @var EntityRepository<Audio>
     */
    private EntityRepository $repo;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Audio::class);
        $this->em = $em;
    }

    public function getById(int $id): Audio
    {
        if (!$Audio = $this->findById($id)) {
            throw new DomainException(
                message: 'error.audio.audio_not_found',
                code: 1
            );
        }

        return $Audio;
    }

    public function findById(int $id): ?Audio
    {
        return $this->repo->findOneBy(['id' => $id]);
    }

    public function add(Audio $Audio): void
    {
        $this->em->persist($Audio);
    }

    public function remove(Audio $Audio): void
    {
        $this->em->remove($Audio);
    }
}
