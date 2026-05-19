<?php

namespace App\Contracts\Services;

use App\Models\Setting;

interface SettingServiceInterface
{
    public function get(string $key, mixed $default = null): mixed;
    public function getMultiple(array $keys): array;
    public function set(string $key, mixed $value): Setting;
    public function setMultiple(array $settings): array;
    public function delete(string $key): bool;
    public function exists(string $key): bool;
    public function clearCache(): void;
}
