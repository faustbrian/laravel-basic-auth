<?php

declare(strict_types=1);

namespace BombenProdukt\BasicAuth;

final class Authenticator
{
    public function __construct(private readonly array $credentials)
    {
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
