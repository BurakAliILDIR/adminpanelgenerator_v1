<?php

use Illuminate\Support\Str;

return [
  
  /*
  |--------------------------------------------------------------------------
  | Default Cache Store
  |--------------------------------------------------------------------------
  |
  | Bu seçenek, bu önbellek kitaplığı kullanılırken kullanılan varsayılan önbellek bağlantısını denetler.
  | Bu bağlantı, belirli bir önbellekleme işlevi yürütülürken açıkça başka bir belirtilmemişse kullanılır.
  |
  | Supported: "apc", "array", "database", "file",
  |            "memcached", "redis", "dynamodb"
  |
  */
  
  'default' => env('CACHE_DRIVER', 'file'),
	
	/*
	|--------------------------------------------------------------------------
	| Cache Stores
	|--------------------------------------------------------------------------
	|
	| Burada uygulamanız için tüm önbellek "stores" ve sürücülerini tanımlayabilirsiniz.
	| Önbelleklerinizde depolanan öğe türlerini gruplamak için aynı
	| önbellek sürücüsü için birden fazla depo tanımlayabilirsiniz.
	|
	*/
  
  'stores' => [
    
    'apc' => [
      'driver' => 'apc',
    ],
    
    'array' => [
      'driver' => 'array',
    ],
    
    'database' => [
      'driver' => 'database',
      'table' => 'cache',
      'connection' => null,
    ],
    
    'file' => [
      'driver' => 'file',
      'path' => storage_path('framework/cache/data'),
    ],
    
    'memcached' => [
      'driver' => 'memcached',
      'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
      'sasl' => [
        env('MEMCACHED_USERNAME'),
        env('MEMCACHED_PASSWORD'),
      ],
      'options' => [
        // Memcached::OPT_CONNECT_TIMEOUT => 2000,
      ],
      'servers' => [
        [
          'host' => env('MEMCACHED_HOST', '127.0.0.1'),
          'port' => env('MEMCACHED_PORT', 11211),
          'weight' => 100,
        ],
      ],
    ],
    
    'redis' => [
      'driver' => 'redis',
      'connection' => 'default',
    ],
    
    'dynamodb' => [
      'driver' => 'dynamodb',
      'key' => env('AWS_ACCESS_KEY_ID'),
      'secret' => env('AWS_SECRET_ACCESS_KEY'),
      'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
      'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
      'endpoint' => env('DYNAMODB_ENDPOINT'),
    ],
  
  ],
  
  /*
  |--------------------------------------------------------------------------
  | Cache Key Prefix
  |--------------------------------------------------------------------------
  |
  | APC veya Memcached gibi RAM tabanlı bir mağaza kullanırken, aynı önbelleği kullanan başka uygulamalar da olabilir. 
  | Dolayısıyla, çarpışmalardan kaçınabilmemiz için tüm anahtarlarımıza önek eklenecek bir değer belirleyeceğiz.
  |
  */
  
  'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_cache'),

];
