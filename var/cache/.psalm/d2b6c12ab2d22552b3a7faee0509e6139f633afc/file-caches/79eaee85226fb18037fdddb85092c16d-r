<?php

declare(strict_types=1);

namespace App\Modules\Audio\Query\GetById;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class AudioGetByIdFetcher
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    /**
     * @throws Exception
     */
    public function fetch(AudioGetByIdQuery $query): ?array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $result = $queryBuilder
            ->select('a.*')
            ->from('audio', 'a')
            ->where('a.id = :id')
            ->andWhere('a.deleted_at IS NULL')
            ->setParameter('id', $query->id)
            ->executeQuery()
            ->fetchAssociative();

        if ($result === false) {
            $result = null;
        }

        return $result;
    }
}
