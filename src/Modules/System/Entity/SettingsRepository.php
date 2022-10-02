<?php

declare(strict_types=1);

namespace App\Modules\System\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class SettingsRepository
{
    /**
     * @var EntityRepository<Settings>
     */
    private EntityRepository $repo;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Settings::class);
        $this->em = $em;
    }

    public function getByPhoto(): Settings
    {
        if (!$settings = $this->findByType('photo')) {
            throw new DomainException(
                message: 'Settings not found!',
                code: 1
            );
        }

        return $settings;
    }

    public function add(Settings $settings): void
    {
        $this->em->persist($settings);
    }

    public function remove(Settings $settings): void
    {
        $this->em->remove($settings);
    }

    private function findByType(string $type): ?Settings
    {
        return $this->repo->findOneBy(['type' => $type]);
    }
}
