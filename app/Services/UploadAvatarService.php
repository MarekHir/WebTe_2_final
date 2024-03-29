<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadAvatarService extends AbstractService
{
    public function run(...$args)
    {
        $image = $args[0];
        $user = Auth::user();

        $user_directory = 'users/' . $user->id;

        Storage::delete(Storage::allFiles('public/' . $user_directory));

        if(Storage::directoryMissing('public/' . $user_directory)) {
            Storage::makeDirectory('public/' . $user_directory);
            Storage::setVisibility('public/users', 'public');
            Storage::setVisibility('public/' . $user_directory, 'public');
        }

        $image_name = Str::random() . '.' . 'png';
        // Create a circular mask
        $mask = Image::canvas(200, 200);
        $mask->circle(200, 100, 100, function ($draw) {
            $draw->background('#ffffff');
        });

        Image::make($image)->fit(200, 200)->mask($mask, false)
            ->save(base_path() . '/storage/app/public/' . $user_directory . '/' . $image_name);

        Storage::setVisibility('public/' . $user_directory . '/' . $image_name, 'public');

        $user->icon = URL::to( env('APP_SUB_DIR') . '/storage/' . $user_directory . '/' . $image_name);
        $user->save();
    }
}
