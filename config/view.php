<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Çoğu şablonlama sistemi şablonları diskten yükler.
    | Burada, görünümleriniz için kontrol edilmesi gereken bir yol dizisi belirtebilirsiniz.
    | Tabii ki her zamanki Laravel görünüm yolu zaten sizin için kaydedildi.
    |
    */

    'paths' => [
        resource_path('views'),
    ],
	
	/*
	|--------------------------------------------------------------------------
	| Compiled View Path
	|--------------------------------------------------------------------------
	|
	| Bu seçenek, derlenen tüm Blade şablonlarının uygulamanız için nerede saklanacağını belirler.
	| Genellikle, bu depolama dizini içindedir. Ancak, her zamanki gibi bu değeri değiştirmekte özgürsünüz.
	|
	*/

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),
	
	/*
	 |--------------------------------------------------------------------------
	 | Blade View Modification Checking
	 |--------------------------------------------------------------------------
	 |
	 | Her istekte, çerçeve, yeniden derlenmesinin gerekip gerekmediğini belirlemek
	 | için bir görünümün süresinin dolup dolmadığını kontrol eder.
	 | Üretim ve ön derleme görünümleri içindeyseniz, zaman kazanmak için bu özellik devre dışı bırakılabilir.
	 |
	 */

    'expires' => env('VIEW_CHECK_EXPIRATION', true),

];
