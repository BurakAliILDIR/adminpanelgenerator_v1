<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Burada, kaynak kökenli kaynak paylaşımı veya "CORS" için ayarlarınızı yapılandırabilirsiniz.
    | Bu, web tarayıcılarında hangi çapraz menşe işlemlerin yürütülebileceğini belirler.
    | Bu ayarları gerektiği gibi ayarlamakta serbestsiniz.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => false,

    'max_age' => false,

    'supports_credentials' => false,

];
