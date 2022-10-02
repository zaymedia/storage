<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Photos;

use App\Components\Serializer\Denormalizer;
use App\Components\Validator\Validator;
use App\Http\Response\JsonDataResponse;
use App\Modules\Photo\Command\Upload\PhotoUploadCommand;
use App\Modules\Photo\Command\Upload\PhotoUploadHandler;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Post(
    path: '/photos',
    description: 'Загрузка изображения',
    summary: 'Загрузка изображения',
    security: [['ApiKeyAuth' => '{}']],
    tags: ['Photos']
)]
#[OA\Response(
    response: '200',
    description: 'Successful operation'
)]
final class UploadAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly Denormalizer $denormalizer,
        private readonly PhotoUploadHandler $handler,
        private readonly Validator $validator,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = $this->denormalizer->denormalize(
            array_merge(
                (array)$request->getParsedBody(),
                [
                    'uploadFilePath' => $_FILES['upload_file']['tmp_name'] ?? '',
                    'queryParams' => (array)$request->getParsedBody(),
                ]
            ),
            PhotoUploadCommand::class
        );

        $this->validator->validate($command);

        return new JsonDataResponse(
            $this->handler->handle($command)
        );
    }
}
