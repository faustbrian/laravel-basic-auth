<?php

declare(strict_types=1);

namespace BombenProdukt\BasicAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use BombenProdukt\BasicAuth\Authenticator;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

final class AuthenticateWithBasicAuth
{
    public function __construct(private readonly Authenticator $authenticator)
    {
        //
    }

    public function handle(Request $request, Closure $next): mixed
    {
        if ($this->authenticator->verify($request->getUser(), $request->getPassword())) {
            return $next($request);
        }

        throw new UnauthorizedHttpException('Basic');
    }
}
