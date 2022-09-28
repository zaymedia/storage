<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Photos;

use App\Components\Router\Route;
use App\Components\Validator\Validator;
use App\Http\Middleware\Identity\Authenticate;
use App\Http\Response\JsonDataSuccessResponse;
use App\Modules\Photo\Command\MarkUse\PhotoMarkUseCommand;
use App\Modules\Photo\Command\MarkUse\PhotoMarkUseHandler;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Delete(
    path: '/photos/{id}',
    description: 'Помечает файл как используемый',
    summary: 'Помечает файл как используемый',
    security: [['bearerAuth' => '{}']],
    tags: ['Photos']
)]
#[OA\Response(
    response: '200',
    description: 'Successful operation'
)]
final class MarkUseAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly PhotoMarkUseHandler $handler,
        private readonly Validator $validator,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = new PhotoMarkUseCommand(
            id: Route::getArgument($request, 'id'),
            secretKey: Authenticate::getSecretKey($request)
        );

        $this->validator->validate($command);

        $this->handler->handle($command);

        return new JsonDataSuccessResponse();
    }
}
