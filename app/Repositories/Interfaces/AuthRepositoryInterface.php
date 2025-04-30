<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function attemptLogin(array $credentials): bool;
    public function logout(): void;
}
