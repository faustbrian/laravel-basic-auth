<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\BasicAuth;

final class Authenticator
{
    public function __construct(
        private readonly array $credentials,
    ) {
        //
    }

    public function verify(?string $username, ?string $password): bool
    {
        if (empty($username) || empty($password)) {
            return false;
        }

        foreach ($this->credentials as $credentials) {
            if (!\password_verify($username, $credentials['username'])) {
                continue;
            }

            if (!\password_verify($password, $credentials['password'])) {
                continue;
            }

            return true;
        }

        return false;
    }
}
