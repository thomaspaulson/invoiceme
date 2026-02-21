<?php

namespace Domain\Models\User;

interface UserRepository
{
    function create(User $user): void;

    function update(User $user): void;

    function uuid(): string;
}
