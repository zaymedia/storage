<?php

declare(strict_types=1);

namespace App\Modules\Photo\Query\GetById;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class PhotoGetByIdFetcher
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    /**
     * @throws Exception
     */
    public function fetch(PhotoGetByIdQuery $query): ?array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $result = $queryBuilder
            ->select('p.*')
            ->from('photo', 'a')
            ->where('p.id = :id')
            ->andWhere('p.deleted_at IS NULL')
            ->setParameter('id', $query->id)
            ->executeQuery()
            ->fetchAssociative();

        if ($result === false) {
            $result = null;
        }

        return $result;
    }
}
