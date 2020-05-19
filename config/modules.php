<?php

use Nwidart\Modules\Activators\FileActivator;

return [
  
  /*
  |--------------------------------------------------------------------------
  | Module Namespace
  |--------------------------------------------------------------------------
  |
  | Varsayılan modül ad alanı.
  |
  */
  
  'namespace' => 'Modules',
	
	/*
	|--------------------------------------------------------------------------
	| Module Stubs
	|--------------------------------------------------------------------------
	|
	| Varsayılan modül saplamaları.
	|
	*/
  
  'stubs' => [
    'enabled' => true,
    'path' => resource_path() . '/stubs',
    'files' => [
      'routes/web' => 'Routes/web.php',
      'routes/api' => 'Routes/api.php',
      'views/index' => 'Resources/views/index.blade.php',
      'views/show' => 'Resources/views/show.blade.php',
      'views/create' => 'Resources/views/create.blade.php',
      'views/edit' => 'Resources/views/edit.blade.php',
      'scaffold/config' => 'Config/config.php',
      'composer' => 'composer.json',
      'assets/js/app' => 'Resources/assets/js/app.js',
      'assets/sass/app' => 'Resources/assets/sass/app.scss',
      'webpack' => 'webpack.mix.js',
      'package' => 'package.json',
    ],
    'replacements' => [
	    'routes/web' => ['LOWER_NAME', 'STUDLY_NAME'],
	    'routes/api' => ['LOWER_NAME'],
	    //'views/index' => ['STUDLY_NAME'],
	    //'views/show' => ['STUDLY_NAME'],
	    //'views/create' => ['STUDLY_NAME'],
	    //'views/edit' => ['STUDLY_NAME'],
	    'webpack' => ['LOWER_NAME'],
	    'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE', 'PROVIDER_NAMESPACE'],
	    'scaffold/config' => ['STUDLY_NAME'],
	    'composer' => [
		    'LOWER_NAME',
		    'STUDLY_NAME',
		    'VENDOR',
		    'AUTHOR_NAME',
		    'AUTHOR_EMAIL',
		    'MODULE_NAMESPACE',
        'PROVIDER_NAMESPACE',
      ],
    ],
    'gitkeep' => false,
  ],
  'paths' => [
	  /*
		|--------------------------------------------------------------------------
		| Modules path
		|--------------------------------------------------------------------------
		|
		| Oluşturulan modülü kaydetmek için kullanılan bu yol.
		| Bu yol ayrıca taranan klasörlerin listesine otomatik olarak eklenir.
		|
		*/
    
    'modules' => base_path('Modules'),
	  /*
		|--------------------------------------------------------------------------
		| Modules assets path
		|--------------------------------------------------------------------------
		|
		| Burada modüllerin varlık yolunu güncelleyebilirsiniz.
		|
		*/
    
    'assets' => public_path('modules'),
	  /*
		|--------------------------------------------------------------------------
		| The migrations path
		|--------------------------------------------------------------------------
		|
		| Nerede 'module:publish-migration' komutunu çalıştırırsınız, taşıma dosyalarını nerede yayınlıyorsunuz?
		|
		*/
    
    'migration' => base_path('database/migrations'),
	  /*
		|--------------------------------------------------------------------------
		| Generator path
		|--------------------------------------------------------------------------
		| Klasörlerin oluşturulacağı yolları özelleştirin.
		| Bu klasörü oluşturmamak için oluşturma anahtarını false olarak ayarlayın
		*/
    'generator' => [
      'config' => ['path' => 'Config', 'generate' => true],
      'command' => ['path' => 'Console', 'generate' => true],
      'migration' => ['path' => 'Database/Migrations', 'generate' => true],
      'seeder' => ['path' => 'Database/Seeders', 'generate' => true],
      'factory' => ['path' => 'Database/factories', 'generate' => true],
      'model' => ['path' => 'Models', 'generate' => true],
      'routes' => ['path' => 'Routes', 'generate' => true],
      'controller' => ['path' => 'Http/Controllers', 'generate' => true],
      'filter' => ['path' => 'Http/Middleware', 'generate' => true],
      'request' => ['path' => 'Http/Requests', 'generate' => true],
      'provider' => ['path' => 'Providers', 'generate' => true],
      'assets' => ['path' => 'Resources/assets', 'generate' => true],
      'lang' => ['path' => 'Resources/lang', 'generate' => true],
      'views' => ['path' => 'Resources/views', 'generate' => true],
      'test' => ['path' => 'Tests/Unit', 'generate' => true],
      'test-feature' => ['path' => 'Tests/Feature', 'generate' => true],
      'repository' => ['path' => 'Repositories', 'generate' => false],
      'event' => ['path' => 'Events', 'generate' => false],
      'listener' => ['path' => 'Listeners', 'generate' => false],
      'policies' => ['path' => 'Policies', 'generate' => false],
      'rules' => ['path' => 'Rules', 'generate' => false],
      'jobs' => ['path' => 'Jobs', 'generate' => false],
      'emails' => ['path' => 'Emails', 'generate' => false],
      'notifications' => ['path' => 'Notifications', 'generate' => false],
      'resource' => ['path' => 'Transformers', 'generate' => false],
    ],
  ],
	/*
	|--------------------------------------------------------------------------
	| Scan Path
	|--------------------------------------------------------------------------
	|
	| Burada hangi klasörün taranacağını tanımlarsınız.
	| Varsayılan olarak satıcı dizinini tarar.
	| Bu, paketi paketci web sitesinde barındırıyorsanız yararlıdır.
	|
	*/
  
  'scan' => [
    'enabled' => false,
    'paths' => [
      base_path('vendor/*/*'),
    ],
  ],
	/*
	|--------------------------------------------------------------------------
	| Composer File Template
	|--------------------------------------------------------------------------
	|
	| Bu paket tarafından oluşturulan composer.json dosyası için yapılandırma
	|
	*/
  
  'composer' => [
    'vendor' => 'TheNobleBrain',
    'author' => [
      'name' => 'Burak Ali ILDIR',
      'email' => 'TheNobleBrain@gmail.com',
    ],
  ],
  /*
  |--------------------------------------------------------------------------
  | Caching
  |--------------------------------------------------------------------------
  |
  | İşte önbellekleme özelliğini ayarlamak için yapılandırma.
  |
  */
  'cache' => [
    'enabled' => false,
    'key' => 'laravel-modules',
    'lifetime' => 60,
  ],
  /*
  |--------------------------------------------------------------------------
  | Hangi laravel modüllerinin özel ad alanları olarak kaydedileceğini seçin.
  | Birini false olarak ayarlamak, bu bölümü kendi Servis Sağlayıcı sınıfınıza kaydetmenizi gerektirir.
  |--------------------------------------------------------------------------
  */
  'register' => [
    'translations' => true,
    /**
     * load files on boot or register method
     * Note: boot not compatible with asgardcms
     * @example boot|register
     */
    'files' => 'register',
  ],
  
  /*
  |--------------------------------------------------------------------------
  | Activators
  |--------------------------------------------------------------------------
  |
  | Burada yeni tip aktivatörler, dosya, veritabanı vb. Tanımlayabilirsiniz. Gerekli olan tek parametre 'sınıf'tır.
  | Dosya aktivatörü aktivasyon durumunu storage/installed_modules depolar
  */
  'activators' => [
    'file' => [
      'class' => FileActivator::class,
      'statuses-file' => base_path('modules_statuses.json'),
      'cache-key' => 'activator.installed',
      'cache-lifetime' => 604800,
    ],
  ],
  
  'activator' => 'file',
];
