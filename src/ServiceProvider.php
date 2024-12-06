<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\BasicAuth;

use BaseCodeOy\Crate\Package\AbstractServiceProvider;
use Illuminate\Contracts\Container\Container;

final class ServiceProvider extends AbstractServiceProvider
{
    #[\Override()]
    public function packageRegistered(): void
    {
        $this->app->singleton(
            'basic.authenticator',
            fn (Container $container): Authenticator => new Authenticator($container->get('config')->get('basic-auth.credentials')),
        );
    }

    #[\Override()]
    public function provides(): array
    {
        return [
            'basic.authenticator',
        ];
    }
}
