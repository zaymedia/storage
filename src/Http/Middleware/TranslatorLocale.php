<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Translation\Translator;

final class TranslatorLocale implements MiddlewareInterface
{
    public function __construct(
        private readonly Translator $translator
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $locale = $request->getHeaderLine('Accept-Language');

        if (!empty($locale)) {
            $this->translator->setLocale($locale);
        }

        return $handler->handle($request);
    }
}
