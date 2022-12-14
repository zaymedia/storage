<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Videos;

use App\Components\Serializer\Denormalizer;
use App\Components\Validator\Validator;
use App\Http\Response\JsonDataSuccessResponse;
use App\Modules\Video\Command\Upload\VideoUploadCommand;
use App\Modules\Video\Command\Upload\VideoUploadHandler;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Post(
    path: '/videos',
    description: 'Загрузка видеозаписи',
    summary: 'Загрузка видеозаписи',
    security: [['ApiKeyAuth' => '{}']],
    tags: ['Videos']
)]
#[OA\Response(
    response: '200',
    description: 'Successful operation'
)]
final class UploadAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly Denormalizer $denormalizer,
        private readonly VideoUploadHandler $handler,
        private readonly Validator $validator,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = $this->denormalizer->denormalize(
            (array)$request->getParsedBody(),
            VideoUploadCommand::class
        );

        $this->validator->validate($command);

        $this->handler->handle($command);

        return new JsonDataSuccessResponse();
    }
}
