<?php
/* TODO : Hataları loglayan ve güzel bir görünümde gösteren package. 
github deposu:
https://github.com/rap2hpoutre/laravel-log-viewer
*/
return [
    /*
    |--------------------------------------------------------------------------
    | Desen ve depolama yolu ayarları
    |--------------------------------------------------------------------------
    |
    | Varsayılan değere sahip desen ve saklama yolu için env tuşu
    |
    */
    'max_file_size' => 100000000, // size in Byte -- 100MB
    'pattern'       => env('LOGVIEWER_PATTERN', '*.log'),
    'storage_path'  => env('LOGVIEWER_STORAGE_PATH', storage_path('logs')),
];
