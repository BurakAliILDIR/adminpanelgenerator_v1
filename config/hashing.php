<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, uygulamanızın parolalarını karma yapmak için kullanılacak varsayılan
    | karma sürücüsünü denetler.
    | Varsayılan olarak, bcrypt algoritması kullanılır;
    | ancak, isterseniz bu seçeneği değiştirmekte özgürsünüz.
    |
    | Supported: "bcrypt", "argon", "argon2id"
    |
    */

    'driver' => 'bcrypt',
	
	/*
	|--------------------------------------------------------------------------
	| Bcrypt Options
	|--------------------------------------------------------------------------
	|
	| Burada, şifreler Bcrypt algoritması kullanılarak karma hale
	| getirildiğinde kullanılması gereken yapılandırma seçeneklerini belirleyebilirsiniz.
	| Bu, verilen şifreyi toplamak için gereken süreyi kontrol etmenizi sağlar.
	|
	*/

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
    ],
	
	/*
	|--------------------------------------------------------------------------
	| Argon Options
	|--------------------------------------------------------------------------
	|
	| Burada, parolaların Argon algoritması kullanılarak karması sırasında
	| kullanılması gereken yapılandırma seçeneklerini belirleyebilirsiniz.
	| Bunlar, verilen şifreyi oluşturmak için geçen süreyi kontrol etmenizi sağlar.
	|
	*/

    'argon' => [
        'memory' => 1024,
        'threads' => 2,
        'time' => 2,
    ],

];
