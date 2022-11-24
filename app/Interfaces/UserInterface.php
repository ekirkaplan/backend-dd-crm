<?php

namespace App\Interfaces;

use App\Models\User;

interface UserInterface extends FilteredInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User;

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User;
}
