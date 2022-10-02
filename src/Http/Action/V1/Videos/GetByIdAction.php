<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Videos;

use App\Components\Router\Route;
use App\Components\Validator\Validator;
use App\Http\Middleware\Identity\Authenticate;
use App\Http\Response\JsonDataResponse;
use App\Modules\Photo\Service\PhotoSerializer;
use App\Modules\Video\Query\GetById\VideoGetByIdFetcher;
use App\Modules\Video\Query\GetById\VideoGetByIdQuery;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Get(
    path: '/videos/{id}',
    description: 'Информация о файле по его идентификатору',
    summary: 'Информация о файле по его идентификатору',
    security: [['ApiKeyAuth' => '{}']],
    tags: ['Videos']
)]
#[OA\Parameter(
    name: 'id',
    description: 'Идентификатор файла',
    in: 'path',
    required: true,
    schema: new OA\Schema(
        type: 'string',
    ),
    example: 1
)]
#[OA\Response(
    response: 200,
    description: 'Successful operation'
)]
final class GetByIdAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly VideoGetByIdFetcher $fetcher,
        private readonly Validator $validator,
        private readonly PhotoSerializer $serializer
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        Authenticate::getApiKey($request);

        $query = new VideoGetByIdQuery(
            id: Route::getArgument($request, 'id'),
        );

        $this->validator->validate($query);

        $result = $this->fetcher->fetch($query);

        return new JsonDataResponse(
            data: $this->serializer->serialize($result)
        );
    }
}
