<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Videos;

use App\Components\Router\Route;
use App\Components\Validator\Validator;
use App\Http\Middleware\Identity\Authenticate;
use App\Http\Response\JsonDataSuccessResponse;
use App\Modules\Video\Command\MarkUse\VideoMarkUseCommand;
use App\Modules\Video\Command\MarkUse\VideoMarkUseHandler;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Patch(
    path: '/videos/{id}',
    description: 'Помечает файл как используемый',
    summary: 'Помечает файл как используемый',
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
    response: '200',
    description: 'Successful operation'
)]
final class MarkUseAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly VideoMarkUseHandler $handler,
        private readonly Validator $validator,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = new VideoMarkUseCommand(
            id: Route::getArgument($request, 'id'),
            apiKey: Authenticate::getApiKey($request)
        );

        $this->validator->validate($command);

        $this->handler->handle($command);

        return new JsonDataSuccessResponse();
    }
}
