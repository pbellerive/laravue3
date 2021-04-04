<?php

namespace App\Helpers;

use Vimeo\Vimeo;

class VimeoHelper
{

    public static function uploadFile($localPath, $title='', $description='')
    {
        $client = new Vimeo(env('VIMEO_CLIENT'), env('VIMEO_CLIENT_SECRET'), env('VIMEO_PERSONAL_ACCESS_TOKEN'));
        $uri = $client->upload($localPath, [
            "name" => $title,
            "description" => $description
        ]);

        return self::getIdFromVideosUri($uri);
    }

    public static function getIdFromVideosUri($uri)
    {
        $split = explode('/', $uri);
        return $split[2] ?? null;
    }
}