<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $repository
    ) {}

    /**
     * Get the authenticated user.
     */
    public function getAuthUser(): User
    {
        return $this->repository->authUser();
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  array<string, mixed>  $data  Validated input from the controller request.
     */
    public function updateProfile(array $data): User
    {
        $user = $this->repository->authUser();

        $updates = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['username'])) {
            $updates['username'] = $data['username'];
        }

        $user = $this->repository->updateProfile($user, $updates);

        if (!empty($data['password'])) {
            $user = $this->repository->updatePassword($user, Hash::make($data['password']));
        }

        return $user;
    }
}
