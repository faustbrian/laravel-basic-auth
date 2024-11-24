<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Feature\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

function getRequest(?string $user, ?string $password)
{
    return Request::create('http://localhost', 'GET', [], [], [], [
        'PHP_AUTH_USER' => $user,
        'PHP_AUTH_PW' => $password,
    ]);
}

it('should verify valid credentials', function (): void {
    $this->assertNull(
        getAuthenticateWithBasicAuth()->handle(getRequest('user', 'password'), function (): void {
            //
        }),
    );
});

it('should fail to verify invalid credentials', function (): void {
    getAuthenticateWithBasicAuth()->handle(getRequest('unauthorized', 'unauthorized'), function (): void {
        //
    });
})->throws(UnauthorizedHttpException::class);

it('should fail to verify empty credentials', function (): void {
    getAuthenticateWithBasicAuth()->handle(getRequest(null, null), function (): void {
        //
    });

    getAuthenticateWithBasicAuth()->handle(getRequest('', ''), function (): void {
        //
    });
})->throws(UnauthorizedHttpException::class);
