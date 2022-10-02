<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Videos;

use App\Components\Router\Route;
use App\Components\Validator\Validator;
use App\Http\Middleware\Identity\Authenticate;
use App\Http\Response\JsonDataSuccessResponse;
use App\Modules\Video\Command\MarkDelete\VideoMarkDeleteCommand;
use App\Modules\Video\Command\MarkDelete\VideoMarkDeleteHandler;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Delete(
    path: '/videos/{id}',
    description: 'Помечает файл как удаленный',
    summary: 'Помечает файл как удаленный',
    security: [['bearerAuth' => '{}']],
    tags: ['Videos']
)]
#[OA\Response(
    response: '200',
    description: 'Successful operation'
)]
final class MarkDeleteAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly VideoMarkDeleteHandler $handler,
        private readonly Validator $validator,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = new VideoMarkDeleteCommand(
            id: Route::getArgument($request, 'id'),
            secretKey: Authenticate::getSecretKey($request)
        );

        $this->validator->validate($command);

        $this->handler->handle($command);

        return new JsonDataSuccessResponse();
    }
}
