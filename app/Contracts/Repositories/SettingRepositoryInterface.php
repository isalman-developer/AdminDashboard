<?php

namespace App\Contracts\Repositories;

use App\Models\Setting;

interface SettingRepositoryInterface
{
    public function get(string $key, mixed $default = null): mixed;
    public function getMultiple(array $keys): array;
    public function set(string $key, string $value): Setting;
    public function delete(string $key): bool;
    public function exists(string $key): bool;
    public function forgetKey(string $key): void;
    public function clearCache(): void;
}
