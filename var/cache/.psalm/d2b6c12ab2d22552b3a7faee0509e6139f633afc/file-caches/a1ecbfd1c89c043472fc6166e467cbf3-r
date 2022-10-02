<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Photos;

use App\Components\Router\Route;
use App\Components\Validator\Validator;
use App\Http\Middleware\Identity\Authenticate;
use App\Http\Response\JsonDataResponse;
use App\Modules\Photo\Query\GetById\PhotoGetByIdFetcher;
use App\Modules\Photo\Query\GetById\PhotoGetByIdQuery;
use App\Modules\Photo\Service\PhotoSerializer;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Get(
    path: '/photos/{id}',
    description: 'Информация о файле по его идентификатору',
    summary: 'Информация о файле по его идентификатору',
    security: [['bearerAuth' => '{}']],
    tags: ['Photos']
)]
#[OA\Response(
    response: 200,
    description: 'Successful operation'
)]
final class GetByIdAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly PhotoGetByIdFetcher $fetcher,
        private readonly Validator $validator,
        private readonly PhotoSerializer $serializer
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $query = new PhotoGetByIdQuery(
            id: Route::getArgument($request, 'id'),
            secretKey: Authenticate::getSecretKey($request)
        );

        $this->validator->validate($query);

        $result = $this->fetcher->fetch($query);

        return new JsonDataResponse(
            data: $this->serializer->serialize($result)
        );
    }
}
