<?php

declare(strict_types=1);

namespace App\Http\Middleware\Identity;

use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpUnauthorizedException;

final class Authenticate implements MiddlewareInterface
{
    private const ATTRIBUTE = 'secretKey';

    public static function findSecretKey(ServerRequestInterface $request): ?string
    {
        $secretKey = $request->getAttribute(self::ATTRIBUTE);

        if ($secretKey !== null && !is_string($secretKey)) {
            throw new LogicException('Invalid secretKey.');
        }

        return $secretKey;
    }

    public static function getSecretKey(ServerRequestInterface $request): string
    {
        $secretKey = self::findSecretKey($request);

        if ($secretKey === null) {
            throw new HttpUnauthorizedException($request);
        }

        return $secretKey;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$request->hasHeader('secretKey')) {
            return $handler->handle($request);
        }

        $secretKey = $request->getHeaderLine('secretKey');

        if (!$this->validateSecretKey($secretKey)) {
            throw new HttpUnauthorizedException($request);
        }

        return $handler->handle($request->withAttribute(self::ATTRIBUTE, $secretKey));
    }

    private function validateSecretKey(string $key): bool
    {
        return ($key != '');
    }
}