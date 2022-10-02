<?php

declare(strict_types=1);

namespace App\Modules\Video\Query\GetById;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class VideoGetByIdFetcher
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    /**
     * @throws Exception
     */
    public function fetch(VideoGetByIdQuery $query): ?array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $result = $queryBuilder
            ->select('v.*')
            ->from('video', 'a')
            ->where('v.id = :id')
            ->andWhere('v.deleted_at IS NULL')
            ->setParameter('id', $query->id)
            ->executeQuery()
            ->fetchAssociative();

        if ($result === false) {
            $result = null;
        }

        return $result;
    }
}
