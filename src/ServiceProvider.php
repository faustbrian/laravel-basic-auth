<?php

declare(strict_types=1);

namespace BaseCodeOy\BasicAuth;

use BaseCodeOy\PackagePowerPack\Package\AbstractServiceProvider;
use Illuminate\Contracts\Container\Container;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->singleton(
            'basic.authenticator',
            fn (Container $app): Authenticator => new Authenticator($app->get('config')->get('basic-auth.credentials')),
        );
    }

    public function provides(): array
    {
        return [
            'basic.authenticator',
        ];
    }
}
