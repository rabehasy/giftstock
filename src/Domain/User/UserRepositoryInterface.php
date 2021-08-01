<?php

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
}
