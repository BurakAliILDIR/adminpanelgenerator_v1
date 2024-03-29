<?php

return [
  
  /*
  |--------------------------------------------------------------------------
  | Third Party Services (Üçüncü Taraf Hizmetleri)
  |--------------------------------------------------------------------------
  |
  | Bu dosya Mailgun, Postmark, AWS ve daha fazlası gibi üçüncü taraf hizmetlerinin kimlik bilgilerini saklamak içindir.
  | Bu dosya, bu tür bilgiler için fiili konumu sağlar ve paketlerin çeşitli hizmet kimlik bilgilerini 
  | bulmak için geleneksel bir dosyaya sahip olmasını sağlar.
  |
  */
  
  'mailgun' => [
    'domain' => env('MAILGUN_DOMAIN'),
    'secret' => env('MAILGUN_SECRET'),
    'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
  ],
  
  'postmark' => [
    'token' => env('POSTMARK_TOKEN'),
  ],
  
  'ses' => [
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
  ],
  
];
