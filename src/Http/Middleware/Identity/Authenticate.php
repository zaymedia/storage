<?php

declare(strict_types=1);

namespace App\Http\Middleware\Identity;

use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpUnauthorizedException;

use function App\Components\env;

final class Authenticate implements MiddlewareInterface
{
    private const ATTRIBUTE = 'apiKey';

    public static function findApiKey(ServerRequestInterface $request): ?string
    {
        /** @var string|null $apiKey */
        $apiKey = $request->getAttribute(self::ATTRIBUTE);

        if ($apiKey !== null && $apiKey !== env('API_KEY')) {
            throw new LogicException('Invalid apiKey.', 409);
        }

        return $apiKey;
    }

    public static function getApiKey(ServerRequestInterface $request): string
    {
        $apiKey = self::findapiKey($request);

        if ($apiKey === null) {
            throw new HttpUnauthorizedException($request);
        }

        return $apiKey;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$request->hasHeader('apiKey')) {
            return $handler->handle($request);
        }

        $apiKey = $request->getHeaderLine('apiKey');

        if (!$this->validateApiKey($apiKey)) {
            throw new HttpUnauthorizedException($request);
        }

        return $handler->handle($request->withAttribute(self::ATTRIBUTE, $apiKey));
    }

    private function validateApiKey(string $key): bool
    {
        return $key !== '';
    }
}
