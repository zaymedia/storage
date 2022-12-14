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

    public function getByFileId(string $fileId): Audio
    {
        if (!$audio = $this->findByFileId($fileId)) {
            throw new DomainException(
                message: 'error.audio.audio_not_found',
                code: 1
            );
        }

        return $audio;
    }

    public function findByFileId(string $fileId): ?Audio
    {
        return $this->repo->findOneBy(['fileId' => $fileId]);
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
