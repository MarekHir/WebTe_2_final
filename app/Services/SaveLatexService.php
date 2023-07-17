<?php

namespace App\Services;

use App\Models\ExercisesList;
use Illuminate\Support\Facades\Storage;

class SaveLatexService extends AbstractService
{


    /**
     * @param ...$args - $args[0] - id of the exercise list, $args[1] - latex file, $args[2] - image files
     * @return array
     * Directory structure: storage/app/exercises/{id}/images/{image_name}
     * File path: storage/app/exercises/{id}/exercises.tex
     */
    public function run(...$args)
    {
        $id = $args[0];
        $latex_file = $args[1];
        $images = $args[2];
        $file_name = 'exercises.tex';

        $base_path = 'exercises/' . $id;
        $base_images_path = $base_path . '/images';
        $prepend_path = 'storage/app/';
        $images_paths = [];

        Storage::makeDirectory($base_path);
        Storage::makeDirectory('public/' . $base_path);
        Storage::setVisibility('public/exercises', 'public');
        Storage::setVisibility('public/' . $base_path, 'public');

        if(!empty($images))
            Storage::makeDirectory($base_images_path);

        $file_path = $latex_file->storeAs($base_path, $file_name);

        foreach ($images as $image) {
            $images_paths[] = $prepend_path . $image->storeAs($base_images_path, $image->getClientOriginalName());
            $image->storePublicAs('public/' . $base_path, $image->getClientOriginalName());
        }


        return [
            'base_path' => $prepend_path . $base_path,
            'file_path' => $prepend_path . $file_path,
            'file_name' => $file_name,
            'images_paths' => $images_paths
        ];
    }
}
