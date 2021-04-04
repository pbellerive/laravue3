<?php

namespace App\Helpers;

// use Imagine\Gd\Imagine;
// use Imagine\Image\Box;

if (!function_exists('resizeImage')) {

    function resizeImage($imageContent, $width, $height) {
        // $imagine = new Imagine();
        // $image = $imagine->load($imageContent);
        // return $image->resize(new Box($width, $height));
        $image = \Image::make($imageContent)->fit($width, $height);

        return $image;
    }
}