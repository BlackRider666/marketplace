<?php

namespace App\Core;

class PathManager
{
    /**
     * @param $thumb
     * @param string $type
     * @return string
     */
    public function getFile($thumb, string $type): string
    {
        return (new StorageManager())->getDisk()->url($type.'/'.$thumb);
    }

    /**
     * @return string
     */
    public function getDefaultPicture(): string
    {
        return env('APP_URL').'/storage/img/default.jpg';
    }
}
