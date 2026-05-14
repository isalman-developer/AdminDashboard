<?php

use App\Services\SettingService;

/**
 * Get a setting value by key.
 *
 * @param string $key     The setting key
 * @param mixed  $default Default value if setting not found
 * @return mixed
 *
 * @example setting('site_name', 'Default Site')
 */
if (!function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return app(SettingService::class)->get($key, $default);
    }
}

/**
 * Get multiple settings at once.
 *
 * @param array $keys Array of setting keys
 * @return array<string, mixed>
 *
 * @example settings(['site_name', 'admin_email', 'items_per_page'])
 */
if (!function_exists('settings')) {
    function settings(array $keys): array
    {
        return app(SettingService::class)->getMultiple($keys);
    }
}
