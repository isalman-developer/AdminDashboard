<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Contracts\Cache\Repository as Cache;

class SettingRepository
{
    /**
     * Cache key prefix for settings.
     */
    protected const CACHE_PREFIX = 'setting.';

    /**
     * Cache TTL in seconds (1 hour).
     */
    protected const CACHE_TTL = 3600;

    /**
     * Create a new SettingRepository instance.
     */
    public function __construct(
        protected Cache $cache
    ) {}

    /**
     * Get all settings (raw model arrays).
     */
    public function all(): array
    {
        return Setting::all()->toArray();
    }

    /**
     * Get a setting value by key.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $cacheKey = self::CACHE_PREFIX . $key;

        $cached = $this->cache->get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $setting = Setting::where('key', $key)->first();
        if (!$setting) {
            return $default;
        }

        $value = $setting->value;
        $this->cache->put($cacheKey, $value, self::CACHE_TTL);

        return $value;
    }

    /**
     * Get multiple settings by keys.
     */
    public function getMultiple(array $keys): array
    {
        if (empty($keys)) {
            return [];
        }

        $cacheKeys = array_map(fn($k) => self::CACHE_PREFIX . $k, $keys);
        $cached = $this->cache->getMultiple($cacheKeys);

        $results = [];
        foreach ($cached as $key => $value) {
            $results[str_replace(self::CACHE_PREFIX, '', $key)] = $value;
        }

        $missingKeys = array_diff($keys, array_keys($results));
        if (empty($missingKeys)) {
            return $results;
        }

        $settings = Setting::whereIn('key', $missingKeys)->get();
        foreach ($settings as $setting) {
            $cacheKey = self::CACHE_PREFIX . $setting->key;
            $this->cache->put($cacheKey, $setting->value, self::CACHE_TTL);
            $results[$setting->key] = $setting->value;
        }

        foreach ($missingKeys as $missingKey) {
            if (!isset($results[$missingKey])) {
                $results[$missingKey] = null;
            }
        }

        return $results;
    }

    /**
     * Set a setting value by key.
     */
    public function set(string $key, string $value): Setting
    {
        $setting = Setting::firstOrNew(['key' => $key]);
        $setting->value = $value;
        $setting->save();

        return $setting;
    }

    /**
     * Delete a setting by key.
     */
    public function delete(string $key): bool
    {
        $setting = Setting::where('key', $key)->first();
        if (!$setting) {
            return false;
        }

        $result = $setting->delete();

        return $result;
    }

    /**
     * Check if a setting exists.
     */
    public function exists(string $key): bool
    {
        return $this->get($key) !== null;
    }

    /**
     * Clear all settings cache.
     */
    public function clearCache(): void
    {
        Setting::cursor()->each(function ($setting) {
            $this->cache->forget(self::CACHE_PREFIX . $setting->key);
        });
    }
}
