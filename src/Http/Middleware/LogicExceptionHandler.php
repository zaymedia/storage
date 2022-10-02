<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Response\JsonErrorResponse;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class LogicExceptionHandler implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (LogicException $exception) {
            return new JsonErrorResponse(
                code: $exception->getCode(),
                message: $exception->getMessage()
            );
        }
    }
}
