<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $repository,
        protected MediaService $mediaService
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

        if (! empty($data['username'])) {
            $updates['username'] = $data['username'];
        }

        $user = $this->repository->updateProfile($user, $updates);

        if (! empty($data['password'])) {
            $user = $this->repository->updatePassword($user, Hash::make($data['password']));
        }

        return $user;
    }

    /**
     * Replace the authenticated user's avatar image.
     * Old file is removed from both DB and disk by MediaService::replace().
     *
     * @return string  Relative path on the public disk, e.g. "avatars/{fileName}"
     */
    public function updateAvatar(mixed $file): string
    {
        $user = $this->repository->authUser();

        return $this->mediaService->replace($file, 'avatars', $user, 'avatar')->file_path;
    }

    /**
     * Get the public URL of the authenticated user's avatar.
     */
    public function getAuthUserAvatarUrl(): string
    {
        $user = $this->repository->authUser();
        $path = $user->media()
            ->where('file_type', 'avatar')
            ->latest('id')
            ->value('file_path');

        // $path is relative to the public disk root, e.g. "avatars/abc.jpg"
        // asset('storage/...') resolves to "/storage/avatars/abc.jpg" via the symlink
        return $path
            ? asset('storage/' . $path)
            : asset('admin-assets/img/avatars/1.png');
    }
}
