<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\BasicAuth\Http\Middleware;

use BaseCodeOy\BasicAuth\Authenticator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

final readonly class AuthenticateWithBasicAuth
{
    public function __construct(
        private Authenticator $authenticator,
    ) {
        //
    }

    public function handle(Request $request, \Closure $next): mixed
    {
        if ($this->authenticator->verify($request->getUser(), $request->getPassword())) {
            return $next($request);
        }

        throw new UnauthorizedHttpException('Basic');
    }
}
