<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Audios;

use App\Components\Serializer\Denormalizer;
use App\Components\Validator\Validator;
use App\Http\Response\JsonDataSuccessResponse;
use App\Modules\Audio\Command\Upload\AudioUploadCommand;
use App\Modules\Audio\Command\Upload\AudioUploadHandler;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Post(
    path: '/audios',
    description: 'Загрузка аудиозаписи',
    summary: 'Загрузка аудиозаписи',
    security: [['ApiKeyAuth' => '{}']],
    tags: ['Audios']
)]
#[OA\Response(
    response: '200',
    description: 'Successful operation'
)]
final class UploadAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly Denormalizer $denormalizer,
        private readonly AudioUploadHandler $handler,
        private readonly Validator $validator,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = $this->denormalizer->denormalize(
            (array)$request->getParsedBody(),
            AudioUploadCommand::class
        );

        $this->validator->validate($command);

        $this->handler->handle($command);

        return new JsonDataSuccessResponse();
    }
}
