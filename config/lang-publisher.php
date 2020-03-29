<?php

use Helldar\PrettyArray\Contracts\Caseable;
/* TODO : Caouecs / Laravel-lang'den Laravel Framework için yayıncı dili dosyaları

sitesi: 
https://packagist.org/packages/andrey-helldar/laravel-lang-publisher
*/
return [
    /*
     * Kaynak çeviri dosyalarının yolu.
     */

    'vendor' => base_path('vendor/caouecs/laravel-lang/src'),

    /*
     * Dizileri işlemeden önce dizilerin anahtarlarla hizalanması gerekiyor mu?
     *
     * Varsayılan olarak true
     */

    'alignment' => true,

    /*
     * Birleştirirken anahtar hariç tutma.
     */

    'exclude' => [
        // 'auth' => ['throttle'],
        // 'pagination' => ['previous'],
        // 'passwords' => ['reset', 'throttled', 'user'],
    ],

    /*
     * Anahtar durumunu değiştirin.
     *
     * Kullanılabilir değerler:
     *
     *   Helldar\PrettyArray\Contracts\Caseable::NO_CASE      - Case does not change
     *   Helldar\PrettyArray\Contracts\Caseable::CAMEL_CASE   - camelCase
     *   Helldar\PrettyArray\Contracts\Caseable::KEBAB_CASE   - kebab-case
     *   Helldar\PrettyArray\Contracts\Caseable::PASCAL_CASE  - PascalCase
     *   Helldar\PrettyArray\Contracts\Caseable::SNAKE_CASE   - snake_case
     *
     * Varsayılan olarak, Caseable::NO_CASE
     */
    'case'    => Caseable::NO_CASE,
];
