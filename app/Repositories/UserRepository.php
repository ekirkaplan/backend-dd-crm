<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

class UserRepository implements UserInterface
{
    /**
     * @param User $user
     */
    public function __construct(protected User $user)
    {
    }

    // todo: asc-desc
    /**
     * @param string|null $search
     * @param int $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->user
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('first_name', 'ilike', "%{$search}%");
                $query->orWhere('last_name', 'ilike', "%{$search}%");
                $query->orWhere('email', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        return $this->user->create($data);
    }

    /**
     * @param array $data
     * @param User $user
     * @return User
     */
    public function update(User $user, array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }
}
