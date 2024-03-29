<?php

return [
  
  /*
  |--------------------------------------------------------------------------
  | Varsayılan Veritabanı Bağlantı Adı
  |--------------------------------------------------------------------------
  |
  | Burada, aşağıdaki veritabanı bağlantılarından hangisini tüm veritabanı işleri için varsayılan bağlantınız 
  | olarak kullanmak istediğinizi belirtebilirsiniz. Tabii ki Veritabanı kütüphanesini kullanarak aynı 
  | anda birçok bağlantı kullanabilirsiniz.
  | 
  |
  */
  
  'default' => env('DB_CONNECTION', 'mysql'),
  
  /*
  |--------------------------------------------------------------------------
  | Database Connections
  |--------------------------------------------------------------------------
  |
  | İşte uygulamanız için veritabanı bağlantıları kurulumlarının her biri.
  | Elbette, Laravel tarafından desteklenen her bir veritabanı platformunu yapılandırma örnekleri, gelişimi
  | kolaylaştırmak için aşağıda gösterilmiştir.
  |
  |
  | Laravel'deki tüm veritabanı çalışmaları PHP PDO tesisleri aracılığıyla yapılır, 
  | bu nedenle geliştirmeye başlamadan önce makinenize seçtiğiniz belirli veritabanı için 
  | sürücünün yüklü olduğundan emin olun.
  | 
  |
  */
  
  'connections' => [
    
    'sqlite' => [
      'driver' => 'sqlite',
      'url' => env('DATABASE_URL'),
      'database' => env('DB_DATABASE', database_path('database.sqlite')),
      'prefix' => '',
      'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
    ],
    
    'mysql' => [
      'driver' => 'mysql',
      'url' => env('DATABASE_URL'),
      'host' => env('DB_HOST', '127.0.0.1'),
      'port' => env('DB_PORT', '3306'),
      'database' => env('DB_DATABASE', 'forge'),
      'username' => env('DB_USERNAME', 'forge'),
      'password' => env('DB_PASSWORD', ''),
      'unix_socket' => env('DB_SOCKET', ''),
      'charset' => 'utf8mb4',
      'collation' => 'utf8mb4_unicode_ci',
      'prefix' => '',
      'prefix_indexes' => true,
      'strict' => true,
      'engine' => null,
      'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
      ]) : [],
    ],
    
    'pgsql' => [
      'driver' => 'pgsql',
      'url' => env('DATABASE_URL'),
      'host' => env('DB_HOST', '127.0.0.1'),
      'port' => env('DB_PORT', '5432'),
      'database' => env('DB_DATABASE', 'forge'),
      'username' => env('DB_USERNAME', 'forge'),
      'password' => env('DB_PASSWORD', ''),
      'charset' => 'utf8',
      'prefix' => '',
      'prefix_indexes' => true,
      'schema' => 'public',
      'sslmode' => 'prefer',
    ],
    
    'sqlsrv' => [
      'driver' => 'sqlsrv',
      'url' => env('DATABASE_URL'),
      'host' => env('DB_HOST', 'localhost'),
      'port' => env('DB_PORT', '1433'),
      'database' => env('DB_DATABASE', 'forge'),
      'username' => env('DB_USERNAME', 'forge'),
      'password' => env('DB_PASSWORD', ''),
      'charset' => 'utf8',
      'prefix' => '',
      'prefix_indexes' => true,
    ],
  
  ],
  
  /*
  |--------------------------------------------------------------------------
  | Taşıma Deposu Tablosu
  |--------------------------------------------------------------------------
  |
  | Bu tablo, uygulamanız için çalıştırılmış olan tüm taşıma işlemlerini izler.
  | Bu bilgileri kullanarak aşağıdakilerden hangisini belirleyebiliriz?
  |   diskteki taşıma işlemleri gerçekten veritabanında çalıştırılmadı.
  |
  */
  
  'migrations' => 'migrations',
  
  /*
  |--------------------------------------------------------------------------
  | Redis Databases
  |--------------------------------------------------------------------------
  |
  | Redis, APC veya Memcached gibi tipik bir anahtar-değer sisteminden daha zengin bir komutlar gövdesi sağlayan açık kaynaklı,
  | hızlı ve gelişmiş bir anahtar/değer deposu. Laravel içeri girmeyi kolaylaştırır.         
  |
  */
  
  'redis' => [
    'client' => 'phpredis',
    'options' => [
      'cluster' => 'redis',
    ],
    'clusters' => [
      'default' => [
        [
          'host' => 'redis-cluster',
          'password' => null,
          'port' => 7000,
          'database' => 0,
        ],
      ],
    ],
  ],

];
