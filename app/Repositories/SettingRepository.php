<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Contracts\Cache\Repository as Cache;

class SettingRepository
{
    protected const CACHE_PREFIX = 'setting.';

    /**
     * In-memory cache for the current request.
     *
     * @var array<string, mixed>
     */
    protected static array $loaded = [];

    /**
     * Cache TTL in seconds (1 hour). Safety net for stale data.
     */
    protected const CACHE_TTL = 3600;

    public function __construct(
        protected Cache $cache
    ) {}

    /**
     * Get a setting value by key.
     * Resolution order: in-memory → Redis → DB.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, self::$loaded)) {
            return self::$loaded[$key];
        }

        $cacheKey = self::CACHE_PREFIX.$key;
        $value = $this->cache->get($cacheKey);

        if ($value === null) {
            $value = Setting::where('key', $key)->value('value');

            if ($value !== null) {
                $this->cache->put($cacheKey, $value, self::CACHE_TTL);
            }
        }

        self::$loaded[$key] = $value ?? $default;

        return self::$loaded[$key];
    }

    /**
     * Get multiple settings by keys in a single pass.
     */
    public function getMultiple(array $keys): array
    {
        if (empty($keys)) {
            return [];
        }

        $results = [];
        $missingFromMemory = [];

        // 1. Drain in-memory hits
        foreach ($keys as $key) {
            if (array_key_exists($key, self::$loaded)) {
                $results[$key] = self::$loaded[$key];
            } else {
                $missingFromMemory[] = $key;
            }
        }

        if (empty($missingFromMemory)) {
            return $results;
        }

        // 2. Check Redis for the remainder
        $cacheKeys = array_map(fn ($k) => self::CACHE_PREFIX.$k, $missingFromMemory);
        $cached = $this->cache->getMultiple($cacheKeys);

        $missingFromCache = [];

        foreach ($cached as $cacheKey => $value) {
            $key = substr($cacheKey, strlen(self::CACHE_PREFIX));
            if ($value !== null) {
                $results[$key] = $value;
                self::$loaded[$key] = $value;
            } else {
                $missingFromCache[] = $key;
            }
        }

        if (empty($missingFromCache)) {
            return $results;
        }

        // 3. Single DB query for the rest
        $dbSettings = Setting::whereIn('key', $missingFromCache)
            ->pluck('value', 'key');

        foreach ($missingFromCache as $key) {
            $value = $dbSettings[$key] ?? null;

            if ($value !== null) {
                $this->cache->put(self::CACHE_PREFIX.$key, $value, self::CACHE_TTL);
            }

            $results[$key] = $value;
            self::$loaded[$key] = $value;
        }

        return $results;
    }

    /**
     * Create or update a setting.  Called exclusively by SettingService::set()
     * which already guards reserved keys.  No business logic here.
     */
    public function set(string $key, string $value): Setting
    {
        $setting = Setting::updateOrCreate(['key' => $key], ['value' => $value]);

        // Eagerly warm both caches so the next read is instant
        $this->cache->put(self::CACHE_PREFIX.$key, $value, self::CACHE_TTL);
        self::$loaded[$key] = $value;

        return $setting;
    }

    /**
     * Delete a setting.
     */
    public function delete(string $key): bool
    {
        $deleted = Setting::where('key', $key)->delete() > 0;

        if ($deleted) {
            $this->forgetKey($key);
        }

        return $deleted;
    }

    /**
     * Check if a setting exists (in cache or DB).
     */
    public function exists(string $key): bool
    {
        return $this->get($key) !== null;
    }

    /**
     * Forget a single key from both cache layers.
     */
    public function forgetKey(string $key): void
    {
        $this->cache->forget(self::CACHE_PREFIX.$key);
        unset(self::$loaded[$key]);
    }

    /**
     * Clear everything — both Redis and in-memory.
     * Rarely used; prefer forgetKey() for single settings.
     */
    public function clearCache(): void
    {
        $keys = array_unique(array_merge(
            array_keys(self::$loaded),
            Setting::pluck('key')->toArray()
        ));

        foreach ($keys as $key) {
            $this->cache->forget(self::CACHE_PREFIX.$key);
        }

        self::$loaded = [];
    }

    /**
     * Clear in-memory cache only.
     */
    public static function clearInMemory(): void
    {
        self::$loaded = [];
    }
}
