<?php

declare(strict_types=1);

namespace BaseCodeOy\BasicAuth\Http\Middleware;

use BaseCodeOy\BasicAuth\Authenticator;
use Closure;
use Illuminate\Http\Request;
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
