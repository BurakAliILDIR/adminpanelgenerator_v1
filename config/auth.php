<?php

return [
  
  /*
  |--------------------------------------------------------------------------
  | Authentication Defaults
  |--------------------------------------------------------------------------
  |
  | Bu seçenek, uygulamanız için varsayılan kimlik doğrulama "guard" ve parola sıfırlama
  | seçeneklerini denetler.
  | Bu varsayılanları gerektiği gibi değiştirebilirsiniz, ancak çoğu uygulama için mükemmel bir başlangıçtır.
  |
  */
  
  'defaults' => [
    'guard' => 'web',
    'passwords' => 'users',
  ],
	
	/*
	|--------------------------------------------------------------------------
	| Authentication Guards
	|--------------------------------------------------------------------------
	|
	| Ardından, uygulamanız için her kimlik doğrulama korumasını tanımlayabilirsiniz.
	| Elbette, burada sizin için oturum depolama alanını ve
	| Eloquent kullanıcı sağlayıcısını kullanan harika bir varsayılan yapılandırma tanımlanmıştır.
	|
	| Tüm kimlik doğrulama sürücülerinin bir kullanıcı sağlayıcısı vardır.
	| Bu, kullanıcıların veritabanınızdan veya bu uygulama tarafından
	| kullanıcı verilerinizi kalıcı hale getirmek için kullanılan diğer
	| depolama mekanizmalarından nasıl alınacağını tanımlar.
	|
	| Supported: "session", "token"
	|
	*/
  
  'guards' => [
    'web' => [
      'driver' => 'session',
      'provider' => 'users',
    ],
    
    'api' => [
      'driver' => 'token',
      'provider' => 'users',
      'hash' => false,
    ],
  ],
	
	/*
	|--------------------------------------------------------------------------
	| User Providers
	|--------------------------------------------------------------------------
	|
	| Tüm kimlik doğrulama sürücülerinin bir kullanıcı sağlayıcısı vardır.
	| Bu, kullanıcıların veritabanınızdan veya bu uygulama tarafından kullanıcı
	| verilerinizi kalıcı hale getirmek için kullanılan diğer depolama
	| mekanizmalarından nasıl alınacağını tanımlar.
	|
	| Birden fazla kullanıcı tablonuz veya modeliniz varsa, her model / table
	| temsil eden birden fazla kaynak yapılandırabilirsiniz.
	| Bu kaynaklar daha sonra tanımladığınız ek kimlik doğrulama korumalarına atanabilir.
	|
	| Supported: "database", "eloquent"
	|
	*/
  
  'providers' => [
    'users' => [
      'driver' => 'eloquent',
      'model' => App\Models\User::class,
    ],
    
    // 'users' => [
    //     'driver' => 'database',
    //     'table' => 'users',
    // ],
  ],
	
	/*
	|--------------------------------------------------------------------------
	| Resetting Passwords
	|--------------------------------------------------------------------------
	|
	| Uygulamada birden fazla kullanıcı tablonuz veya modeliniz varsa ve
	| belirli kullanıcı türlerine göre ayrı şifre sıfırlama ayarlarına sahip olmak istiyorsanız,
	| birden çok şifre sıfırlama yapılandırması belirtebilirsiniz.
	|
	| Son kullanma süresi, sıfırlama simgesinin geçerli sayılması gereken dakika sayısıdır.
	| Bu güvenlik özelliği, jetonları kısa ömürlü tutar, böylece tahmin edilmesi daha az zaman alır.
	| Bunu gerektiği gibi değiştirebilirsiniz.
	|
	*/
  
  'passwords' => [
    'users' => [
      'provider' => 'users',
      'table' => 'password_resets',
      'expire' => 60,
      'throttle' => 60,
    ],
  ],
	
	/*
	|--------------------------------------------------------------------------
	| Password Confirmation Timeout
	|--------------------------------------------------------------------------
	|
	| Burada, şifre onayının zaman aşımına uğramadan ve kullanıcıdan onay
	| ekranından şifresini tekrar girmesi istenecek saniye sayısını belirleyebilirsiniz.
	| Varsayılan olarak, zaman aşımı üç saat sürer.
	|
	*/
  
  'password_timeout' => 10800,

];
