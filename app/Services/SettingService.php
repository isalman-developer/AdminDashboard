<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\DB;

class SettingService
{
    /**
     * Reserved setting keys that cannot be modified.
     */
    protected const RESERVED_KEYS = [
        'app_key',
        'app_name',
        'app_env',
        'app_debug',
        'app_url',
    ];

    public function __construct(
        protected SettingRepository $repository
    ) {}

    /**
     * Return the four admin-form settings with their defaults.
     *
     * @return array<string, mixed>
     */
    public function getAdminFormSettings(): array
    {
        return [
            'site_admin_name'  => $this->get('site_admin_name', config('app.name')),
            'site_name'        => $this->get('site_name', config('app.name')),
            'site_email'       => $this->get('site_email'),
            'site_description' => $this->get('site_description'),
            'items_per_page'   => $this->get('items_per_page', config('admin.pagination_per_page')),
        ];
    }

    /**
     * Persist admin-form settings from validated request data.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, Setting>
     */
    public function saveAdminFormSettings(array $validated): array
    {
        return $this->setMultiple([
            'site_name'        => $validated['site_name'],
            'site_admin_name'  => $validated['site_admin_name'],
            'site_email'       => $validated['site_email'] ?? '',
            'site_description' => $validated['site_description'] ?? '',
            'items_per_page'   => (int) $validated['items_per_page'],
        ]);
    }

    /**
     * Get a setting value by key.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->repository->get($key, $default);
    }

    /**
     * Get multiple settings by keys.
     */
    public function getMultiple(array $keys): array
    {
        return $this->repository->getMultiple($keys);
    }

    /**
     * Set a setting value (accepts mixed, auto-converts to storable string).
     */
    public function set(string $key, mixed $value): Setting
    {
        $this->guardReserved($key, 'modify');

        return $this->repository->set($key, $this->toStorableValue($value));
    }

    /**
     * Set multiple settings at once.
     *
     * @param  array<string, mixed>  $settings  ['key' => value, ...]
     */
    public function setMultiple(array $settings): array
    {
        return DB::transaction(function () use ($settings): array {
            $results = [];
            foreach ($settings as $key => $value) {
                $results[$key] = $this->set($key, $value);
            }

            return $results;
        });
    }

    /**
     * Delete a setting.
     */
    public function delete(string $key): bool
    {
        $this->guardReserved($key, 'delete');

        return $this->repository->delete($key);
    }

    /**
     * Check if a setting exists.
     */
    public function exists(string $key): bool
    {
        return $this->repository->exists($key);
    }

    /**
     * Clear all settings cache.
     */
    public function clearCache(): void
    {
        $this->repository->clearCache();
    }

    /**
     * Throw if the key is reserved.
     */
    protected function guardReserved(string $key, string $action): void
    {
        if (in_array(strtolower($key), self::RESERVED_KEYS, true)) {
            throw new \RuntimeException("Cannot {$action} reserved setting key: {$key}");
        }
    }

    /**
     * Convert any value to a storable string.
     */
    protected function toStorableValue(mixed $value): string
    {
        return match (true) {
            is_array($value) || is_object($value) => json_encode($value),
            is_bool($value) => $value ? '1' : '0',
            default => (string) $value,
        };
    }
}
