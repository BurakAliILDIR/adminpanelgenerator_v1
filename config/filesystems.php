<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Burada, çerçeve tarafından kullanılması gereken varsayılan 
    | dosya sistemi diskini belirtebilirsiniz. Uygulamanız için "local" 
    | disk ve çeşitli bulut tabanlı diskler kullanılabilir. Sadece sakla!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Birçok uygulama dosyaları hem yerel olarak hem de bulutta depolar.
    | Bu nedenle, burada varsayılan bir "cloud" sürücüsü belirtebilirsiniz.
    | Bu sürücü, kapsayıcıdaki Cloud disk uygulaması olarak bağlanır.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Burada istediğiniz kadar dosya sistemi "disks" yapılandırabilir ve 
    | hatta aynı sürücünün birden fazla diskini yapılandırabilirsiniz.
    | Gerekli seçeneklere örnek olarak her sürücü için varsayılan değerler ayarlanmıştır.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

        'media' => [
            'driver' => 'local',
            'root' => public_path() . '/media',
            'url' => env('APP_URL') . '/media',
            'visibility' => 'public',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Burada `storage: link` Artisan komutu yürütüldüğünde oluşturulacak sembolik bağlantıları 
    | yapılandırabilirsiniz. Dizi anahtarları bağlantıların yerleri ve değerler hedefleri olmalıdır.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
