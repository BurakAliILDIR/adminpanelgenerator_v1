<?php

return [
  
  /*
  |--------------------------------------------------------------------------
  | Default Mailer
  |--------------------------------------------------------------------------
  |
  | Bu seçenek, herhangi bir e-posta göndermek için kullanılan varsayılan postayı kontrol eder
  | uygulamanız tarafından gönderilen iletiler. Alternatif postalar oluşturulabilir
  | ve gerektiği gibi kullanılır; ancak, bu posta varsayılan olarak kullanılacaktır.
  |
  */
  
  'default' => env('MAIL_MAILER', 'smtp'),
  
  /*
  |--------------------------------------------------------------------------
  | Mailer Configurations
  |--------------------------------------------------------------------------
  |
  | Burada uygulamanızın kullandığı tüm postaları artı
  | ilgili ayarları. İçin birkaç örnek yapılandırıldı
  | sizin ve uygulamanızın gerektirdiği gibi kendi ekleyebilirsiniz.
  |                                                                         
  | Laravel, çeşitli posta "taşıma" sürücülerini
  | Bir e-posta göndermek. Sizin için hangisini kullandığınızı belirleyeceksiniz.
  | aşağıdaki postalar. Gerektiğinde ek postalar ekleyebilirsiniz.
  |
  | Supported: "smtp", "sendmail", "mailgun", "ses",
  |            "postmark", "log", "array"
  |
  */
  
  'mailers' => [
    'smtp' => [
      'transport' => 'smtp',
      'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
      'port' => env('MAIL_PORT', 587),
      'encryption' => env('MAIL_ENCRYPTION', 'tls'),
      'username' => env('MAIL_USERNAME'),
      'password' => env('MAIL_PASSWORD'),
    ],
    
    'ses' => [
      'transport' => 'ses',
    ],
    
    'sendmail' => [
      'transport' => 'sendmail',
      'path' => '/usr/sbin/sendmail -bs',
    ],
    
    'log' => [
      'transport' => 'log',
      'channel' => env('MAIL_LOG_CHANNEL'),
    ],
    
    'array' => [
      'transport' => 'array',
    ],
  ],
  
  /*
  |--------------------------------------------------------------------------
  | Global "From" Address
  |--------------------------------------------------------------------------
  |
  | Başvurunuz tarafından gönderilen tüm e-postaların gönderilmesini isteyebilirsiniz
  | aynı adres. Burada, bir ad ve adres belirtebilirsiniz.
  | global olarak uygulamanız tarafından gönderilen tüm e-postalar için kullanılır.
  |
  */
  
  'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
    'name' => env('MAIL_FROM_NAME', 'Example'),
  ],
  
  /*
  |--------------------------------------------------------------------------
  | Markdown Mail Settings
  |--------------------------------------------------------------------------
  |
  | Markdown tabanlı e-posta oluşturma özelliğini kullanıyorsanız,
  | temayı ve bileşen yollarını burada bulabilirsiniz, böylece tasarımı özelleştirebilirsiniz
  | e-postaları. Veya Laravel varsayılanlarına sadık kalabilirsiniz!
  |
  */
  
  'markdown' => [
    'theme' => 'default',
    
    'paths' => [
      resource_path('views/vendor/mail'),
    ],
  ],

];
