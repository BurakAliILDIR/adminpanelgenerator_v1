<?php

return [
  
  /*
  |--------------------------------------------------------------------------
  | Default Queue Connection Name
  |--------------------------------------------------------------------------
  |
  | Laravel'in kuyruk API'si, tek bir API aracılığıyla arka uç çeşitliliğini destekler,
  | böylece her biri için aynı sözdizimini kullanarak her arka uca kolay erişim sağlar.
  | Burada varsayılan bir bağlantı tanımlayabilirsiniz.
  |
  */
  
  'default' => env('QUEUE_CONNECTION', 'sync'),
	
	/*
	|--------------------------------------------------------------------------
	| Queue Connections
	|--------------------------------------------------------------------------
	|
	| Burada uygulamanız tarafından kullanılan her sunucu için bağlantı bilgilerini yapılandırabilirsiniz.
	| Laravel ile gönderilen her bir arka uç için varsayılan bir yapılandırma eklenmiştir.
	| Daha fazlasını eklemekte özgürsünüz.
	|
	| Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
	|
	*/
  
  'connections' => [
    
    'sync' => [
      'driver' => 'sync',
    ],
    
    'database' => [
      'driver' => 'database',
      'table' => 'jobs',
      'queue' => 'default',
      'retry_after' => 90,
    ],
    
    'beanstalkd' => [
      'driver' => 'beanstalkd',
      'host' => 'localhost',
      'queue' => 'default',
      'retry_after' => 90,
      'block_for' => 0,
    ],
    
    'sqs' => [
      'driver' => 'sqs',
      'key' => env('AWS_ACCESS_KEY_ID'),
      'secret' => env('AWS_SECRET_ACCESS_KEY'),
      'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
      'queue' => env('SQS_QUEUE', 'your-queue-name'),
      'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'redis' => [
      'driver' => 'redis',
      'connection' => 'default',
      'queue' => env('REDIS_QUEUE', 'default'), 
      'retry_after' => 90,
      'block_for' => null,
    ],
  
  ],
	
	/*
	|--------------------------------------------------------------------------
	| Failed Queue Jobs
	|--------------------------------------------------------------------------
	|
	| Bu seçenekler, başarısız olan sıralı iş günlüğü davranışını yapılandırır,
	| böylece başarısız olan işleri depolamak için hangi veritabanının ve tablonun kullanılacağını denetleyebilirsiniz.
	| Bunları istediğiniz herhangi bir database / table değiştirebilirsiniz.
	|
	*/
  
  'failed' => [
    'driver' => env('QUEUE_FAILED_DRIVER', 'database'),
    'database' => env('DB_CONNECTION', 'mysql'),
    'table' => 'failed_jobs',
  ],

];
