<?php

return [
  
  /*
  |--------------------------------------------------------------------------
  | Application Name
  |--------------------------------------------------------------------------
  |
  | Bu değer, uygulamanızın adıdır. Bu değer, çerçevenin uygulamanın adını 
  | bir bildirime veya uygulamanın veya paketlerinin gerektirdiği başka bir 
  | konuma yerleştirmesi gerektiğinde kullanılır.
  |
  */
  
  'name' => env('APP_NAME', 'Laravel'),
  
  /*
   |--------------------------------------------------------------------------
   | Application Description
   |--------------------------------------------------------------------------
   |
   */
  
  'description' => env('APP_DESCRIPTION', 'Laravel'),
  
  /*
  |--------------------------------------------------------------------------
  | Application Environment
  |--------------------------------------------------------------------------
  |
  | Bu değer, uygulamanızın çalışmakta olduğu "ortamı" belirler. 
  | Bu, uygulamanın kullandığı çeşitli hizmetleri nasıl yapılandırmayı tercih ettiğinizi belirleyebilir. 
  | Bunu ".env" dosyanızda ayarlayın.
  |
  */
  
  'env' => env('APP_ENV', 'production'),
  
  /*
  |--------------------------------------------------------------------------
  | Application Debug Mode
  |--------------------------------------------------------------------------
  |
  | Uygulamanız hata ayıklama modundayken, uygulamanızda oluşan her hatada yığın izlemelerine 
  | sahip ayrıntılı hata mesajları gösterilir. Devre dışı bırakılırsa, 
  | basit bir genel hata sayfası gösterilir.
  | 
  | 
  |
  */
  
  'debug' => env('APP_DEBUG', false),
  
  /*
  |--------------------------------------------------------------------------
  | Application URL
  |--------------------------------------------------------------------------
  |
  | Bu URL, Artisan komut satırı aracını kullanırken konsol tarafından URL'leri düzgün bir şekilde 
  | oluşturmak için kullanılır. Bunu Artisan görevlerini çalıştırırken kullanılacak şekilde 
  | uygulamanızın kök dizinine ayarlamalısınız.
  |
  */
  
  'url' => env('APP_URL', 'http://localhost'),
  
  'asset_url' => env('ASSET_URL', null),
  
  /*
  |--------------------------------------------------------------------------
  | Application Timezone
  |--------------------------------------------------------------------------
  |
  | Burada uygulamanız için PHP tarih ve tarih-saat işlevleri tarafından kullanılacak varsayılan 
  | saat dilimini belirtebilirsiniz. İlerledik ve bunu sizin için kutunun dışında makul bir 
  | varsayılana ayarladık.
  |
  */
  
  'timezone' => 'Europe/Istanbul',
  
  /*
  |--------------------------------------------------------------------------
  | Application Locale Configuration
  |--------------------------------------------------------------------------
  |
  | Uygulama yerel ayarı, çeviri hizmeti sağlayıcısı tarafından kullanılacak varsayılan yerel ayarı belirler. 
  | Bu değeri, uygulama tarafından desteklenecek yerel ayarlardan herhangi birine ayarlayabilirsiniz.
  |
  */
  
  'locale' => 'tr',
  
  /*
  |--------------------------------------------------------------------------
  | Application Fallback Locale
  |--------------------------------------------------------------------------
  |
  | Yedek yerel ayar, geçerli yerel ayarda kullanılacak yerel ayarı belirler.
  | mevcut değil. Değeri, herhangi birine karşılık gelecek şekilde değiştirebilirsiniz.
  | uygulamanız aracılığıyla sağlanan dil klasörleri.
  |
  */
  
  'fallback_locale' => 'tr',
  
  /*
  |--------------------------------------------------------------------------
  | Faker Locale
  |--------------------------------------------------------------------------
  |
  | Bu yerel ayar, veritabanı tohumlarınız için sahte veriler oluştururken 
  | Faker PHP kütüphanesi tarafından kullanılacaktır. Örneğin, yerel telefon numaraları, 
  | sokak adresi bilgileri ve daha fazlasını elde etmek için bu kullanılır.
  |
  */
  
  'faker_locale' => 'en_US',
  
  /*
  |--------------------------------------------------------------------------
  | Encryption Key
  |--------------------------------------------------------------------------
  |
  | Bu anahtar Illuminate şifreleme hizmeti tarafından kullanılır ve rastgele, 
  | 32 karakterlik bir dizeye ayarlanmalıdır, aksi takdirde bu şifrelenmiş dizeler güvenli olmaz. 
  | Bir uygulamayı dağıtmadan önce lütfen bunu yapın!
  |
  */
  
  'key' => env('APP_KEY'),
  
  'cipher' => 'AES-256-CBC',
  
  /*
  |--------------------------------------------------------------------------
  | Autoloaded Service Providers
  |--------------------------------------------------------------------------
  |
  | Burada listelenen servis sağlayıcılar, uygulamanıza yapılan talep üzerine otomatik olarak yüklenecektir. 
  | Uygulamalarınıza genişletilmiş işlevsellik kazandırmak için bu diziye kendi hizmetlerinizi 
  | eklemekten çekinmeyin.
  |
  */
  
  'providers' => [
    
    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    Illuminate\Database\DatabaseServiceProvider::class,
    Illuminate\Encryption\EncryptionServiceProvider::class,
    Illuminate\Filesystem\FilesystemServiceProvider::class,
    Illuminate\Foundation\Providers\FoundationServiceProvider::class,
    Illuminate\Hashing\HashServiceProvider::class,
    Illuminate\Mail\MailServiceProvider::class,
    Illuminate\Notifications\NotificationServiceProvider::class,
    Illuminate\Pagination\PaginationServiceProvider::class,
    Illuminate\Pipeline\PipelineServiceProvider::class,
    Illuminate\Queue\QueueServiceProvider::class,
    Illuminate\Redis\RedisServiceProvider::class,
    Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
    Illuminate\Session\SessionServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    Illuminate\View\ViewServiceProvider::class,
  
    /*
     * Package Service Providers...
     */
  
    /*
     * Application Service Providers...
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\BroadcastServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,

  ],
  
  /*
  |--------------------------------------------------------------------------
  | Class Aliases
  |--------------------------------------------------------------------------
  |
  | Bu sınıf takma adları dizisi, bu uygulama başlatıldığında kaydedilecektir. 
  | Ancak, takma adlar "lazy" yüklendiği için istediğiniz kadar kayıt yaptırmaktan çekinmeyin, 
  | böylece performansı engellemezler.
  |
  */
  
  'aliases' => [
    
    'App' => Illuminate\Support\Facades\App::class,
    'Arr' => Illuminate\Support\Arr::class,
    'Artisan' => Illuminate\Support\Facades\Artisan::class,
    'Auth' => Illuminate\Support\Facades\Auth::class,
    'Blade' => Illuminate\Support\Facades\Blade::class,
    'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
    'Bus' => Illuminate\Support\Facades\Bus::class,
    'Cache' => Illuminate\Support\Facades\Cache::class,
    'Config' => Illuminate\Support\Facades\Config::class,
    'Cookie' => Illuminate\Support\Facades\Cookie::class,
    'Crypt' => Illuminate\Support\Facades\Crypt::class,
    'DB' => Illuminate\Support\Facades\DB::class,
    'Eloquent' => Illuminate\Database\Eloquent\Model::class,
    'Event' => Illuminate\Support\Facades\Event::class,
    'File' => Illuminate\Support\Facades\File::class,
    'Gate' => Illuminate\Support\Facades\Gate::class,
    'Hash' => Illuminate\Support\Facades\Hash::class,
    'Http' => Illuminate\Support\Facades\Http::class,
    'Lang' => Illuminate\Support\Facades\Lang::class,
    'Log' => Illuminate\Support\Facades\Log::class,
    'Mail' => Illuminate\Support\Facades\Mail::class,
    'Notification' => Illuminate\Support\Facades\Notification::class,
    'Password' => Illuminate\Support\Facades\Password::class,
    'Queue' => Illuminate\Support\Facades\Queue::class,
    'Redirect' => Illuminate\Support\Facades\Redirect::class,
    'Redis' => Illuminate\Support\Facades\Redis::class,
    'Request' => Illuminate\Support\Facades\Request::class,
    'Response' => Illuminate\Support\Facades\Response::class,
    'Route' => Illuminate\Support\Facades\Route::class,
    'Schema' => Illuminate\Support\Facades\Schema::class,
    'Session' => Illuminate\Support\Facades\Session::class,
    'Storage' => Illuminate\Support\Facades\Storage::class,
    'Str' => Illuminate\Support\Str::class,
    'URL' => Illuminate\Support\Facades\URL::class,
    'Validator' => Illuminate\Support\Facades\Validator::class,
    'View' => Illuminate\Support\Facades\View::class,
	'RedisManager' => Illuminate\Support\Facades\Redis::class,

  ],

];
