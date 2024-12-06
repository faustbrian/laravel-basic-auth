<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\BasicAuth;

final readonly class Authenticator
{
    public function __construct(
        private array $credentials,
    ) {
        //
    }

    public function verify(?string $username, ?string $password): bool
    {
        if (blank($username) || blank($password)) {
            return false;
        }

        foreach ($this->credentials as $credential) {
            if (!\password_verify($username, (string) $credential['username'])) {
                continue;
            }

            if (!\password_verify($password, (string) $credential['password'])) {
                continue;
            }

            return true;
        }

        return false;
    }
}
