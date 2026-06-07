<?php

use App\Models\Files;
use App\Services\SettingService;
use Illuminate\Support\Facades\File;

// checking navbar active
if (!function_exists('checkActive')) {
    function checkActive($route)
    {
        return request()->routeIs($route) ? 'active' : '';
    }
}

// checking navbar parent active
if (!function_exists('checkParentActive')) {
    function checkParentActive($routesArray)
    {
        foreach ($routesArray as $key => $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
    }
}

//return status badge html
if (!function_exists('statusBadge')) {
    function statusBadge($status)
    {
        return "<span class='badge badge-" . ($status == 1 ? 'success' : 'info') . "'> " . ($status == 1 ? 'Active' : 'In-Active') . " </span>";
    }
}

//Check SelectedOption
if (!function_exists('checkSelectedOption')) {
    function checkSelectedOption($objectValue, $value)
    {
        if ($objectValue == $value) {
            return 'selected';
        } else {
            return '';
        }
    }
}

//store image
if (!function_exists('storeImage')) {
    function storeImage($file, $path, $title, $object)
    {
        $name = str()->slug($title) . rand(1, 50) . '.' . $file->extension();
        $file->move(public_path($path), $name);

        $fileObject = new Files();
        $fileObject->path = ($path . $name);
        $object->files()->save($fileObject);
    }
}

//update image
if (!function_exists('updateImage')) {
    function updateImage($file, $path, $title, $object)
    {
        $name = str()->slug($title) . rand(1, 50) . '.' . $file->extension();
        $file->move(public_path($path), $name);

        $fileObject = new Files();
        $fileObject->path = ($path . $name);
        $object->files()->save($fileObject);
    }
}

//delete image
if (!function_exists('deleteImage')) {
    function deleteImage($object)
    {
        // deleting files
        foreach ($object->files as $key => $file) {
            if (File::exists(public_path($file->path))) {
                File::delete(public_path($file->path));
            }
        }

        // deleting from database
        $object->files->each->delete();
    }
}


//show image
if (!function_exists('showImage')) {
    function showImage($path)
    {
        if (isset($path)) {
            return asset($path);
        } elseif (File::exists(public_path($path))) {
            return 'default-image.jpg';
        } else {
            return 'default-image.jpg';
        }
    }
}

// writing config files
if (!function_exists('writeConfigFile')) {
    function writeConfigFile($result, $keys, $fileName)
    {
        if (count($result) > 0) {
            // if record exist write them
            $array = [];
            // iterating values or data from model
            foreach ($result as $i => $value) {
                // iterating keys / columns
                foreach ($keys as $j => $key) {
                    // for file
                    if ($key == 'path') {
                        $object[$key] = $value->files[0]->path ?? 'default-image.jpg';
                    } else {
                        // for other fields
                        $object[$key] = $value->$key ?? null;
                    }
                }
                array_push($array, $object);
            }

            // stringify the content
            $stringify_settings = var_export($array, true);

            // making the syntax that has to be written to file in below line
            $content = "<?php return {$stringify_settings};";

            File::put(config_path("$fileName.php"), $content);
        } else {

            // if record doesn't exist then write the empty array to the file
            $content = "<?php return [];";
            File::put(config_path("$fileName.php"), $content);
        }
    }
}

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return app(SettingService::class)->get($key, $default);
    }
}
