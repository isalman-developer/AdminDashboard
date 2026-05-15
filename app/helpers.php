<?php

use App\Models\Media;
use App\Services\SettingService;
use Illuminate\Support\Str;


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


if (!function_exists('uploadMedia')) {
    function uploadMedia($file, $folder = 'media', $model): string
    {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = strtolower(Str::random(15) . '.' . $fileExtension);
        $filePath = public_path('uploads' . DIRECTORY_SEPARATOR . $folder);
        if (!is_dir($filePath)) {
            mkdir($filePath, 0775, true);
        }
        $file->move($filePath, $fileName);

        $media = Media::create([
            'file_path' => $folder . DIRECTORY_SEPARATOR . $fileName,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'file_name' => $fileName,
            'file_size' => $file->getSize(),
            'file_type' => $file->getMimeType(),
        ]);

        return $media->file_path;
    }
}
