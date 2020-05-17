<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, isteklerde kullanılacak varsayılan oturum "driver" ını denetler.
    | Varsayılan olarak, hafif yerel sürücüyü kullanacağız,
    | ancak burada sağlanan diğer harika sürücülerden herhangi birini belirtebilirsiniz.
    |
    | Supported: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),
	
	/*
	|--------------------------------------------------------------------------
	| Session Lifetime
	|--------------------------------------------------------------------------
	|
	| Burada, oturumun süresi dolmadan önce boşta kalmasına izin verilecek dakika sayısını belirleyebilirsiniz.
	| Tarayıcı kapanışında hemen sürelerinin dolmasını istiyorsanız, bu seçeneği belirleyin.
	|
	*/

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,
	
	/*
	|--------------------------------------------------------------------------
	| Session Encryption
	|--------------------------------------------------------------------------
	|
	| Bu seçenek, tüm oturum verilerinizin depolanmadan önce şifrelenmesi gerektiğini kolayca belirlemenizi sağlar.
	| Tüm şifreleme Laravel tarafından otomatik olarak çalıştırılacak ve Oturumu normal gibi kullanabilirsiniz.
	|
	*/

    'encrypt' => false,
	
	/*
	|--------------------------------------------------------------------------
	| Session File Location
	|--------------------------------------------------------------------------
	|
	| Yerel oturum sürücüsünü kullanırken, oturum dosyalarının depolanabileceği bir konuma ihtiyacımız var.
	| Sizin için bir varsayılan ayarlandı, ancak farklı bir konum belirtilebilir.
	| Bu yalnızca dosya oturumları için gereklidir.
	|
	*/

    'files' => storage_path('framework/sessions'),
	
	/*
	|--------------------------------------------------------------------------
	| Session Database Connection
	|--------------------------------------------------------------------------
	|
	| "database" veya "redis" oturum sürücülerini kullanırken,
	| bu oturumları yönetmek için kullanılması gereken bir bağlantı belirtebilirsiniz.
	| Bu, veritabanı yapılandırma seçeneklerinizdeki bir bağlantıya karşılık gelmelidir.
	|
	*/

    'connection' => env('SESSION_CONNECTION', null),
	
	/*
	|--------------------------------------------------------------------------
	| Session Database Table
	|--------------------------------------------------------------------------
	|
	| "database" oturum sürücüsünü kullanırken, oturumları yönetmek için kullanmamız gereken tabloyu belirleyebilirsiniz.
	| Elbette sizin için mantıklı bir temerrüt sağlanmıştır; ancak bunu gerektiği gibi değiştirmekte özgürsünüz.
	|
	*/

    'table' => 'sessions',
	
	/*
	|--------------------------------------------------------------------------
	| Session Cache Store
	|--------------------------------------------------------------------------
	|
	| "apc", "memcached" veya "dynamodb" oturum sürücülerini kullanırken, bu
	| oturumlar için kullanılması gereken bir önbellek deposunu listeleyebilirsiniz.
	| Bu değer, uygulamanın yapılandırılmış önbellek "stores" biriyle eşleşmelidir.
	|
	*/

    'store' => env('SESSION_STORE', null),
	
	/*
	|--------------------------------------------------------------------------
	| Session Sweeping Lottery
	|--------------------------------------------------------------------------
	|
	| Bazı oturum sürücülerinin eski oturumlardan depolama alanından kurtulmak için depolama konumlarını el ile taramaları gerekir.
	| İşte belirli bir talep üzerine gerçekleşme şansı. Varsayılan olarak, oranlar 100 üzerinden 2'dir.
	|
	*/

    'lottery' => [2, 100],
	
	/*
	|--------------------------------------------------------------------------
	| Session Cookie Name
	|--------------------------------------------------------------------------
	|
	| Burada, bir oturum örneğini kimliğe göre tanımlamak için kullanılan çerezin adını değiştirebilirsiniz.
	| Burada belirtilen ad, her sürücü için çerçeve tarafından her yeni oturum çerezi oluşturulduğunda kullanılacaktır.
	|
	*/

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),
	
	/*
	|--------------------------------------------------------------------------
	| Session Cookie Path
	|--------------------------------------------------------------------------
	|
	| Oturum çerezi yolu, çerezin kullanılabilir olarak kabul edileceği yolu belirler.
	| Genellikle, bu uygulamanızın kök yolu olacaktır, ancak gerektiğinde bunu değiştirmekte özgürsünüz.
	|
	*/

    'path' => '/',
	
	/*
	|--------------------------------------------------------------------------
	| Session Cookie Domain
	|--------------------------------------------------------------------------
	|
	| Burada, uygulamanızdaki bir oturumu tanımlamak için kullanılan çerezin alan adını değiştirebilirsiniz.
	| Bu, çerezin uygulamanızda hangi alan adlarında kullanılabileceğini belirler. Mantıklı bir varsayılan ayarlandı.
	|
	*/

    'domain' => env('SESSION_DOMAIN', null),
	
	/*
	|--------------------------------------------------------------------------
	| HTTPS Only Cookies
	|--------------------------------------------------------------------------
	|
	| Bu seçenek true olarak ayarlandığında, oturum çerezleri yalnızca tarayıcıda HTTPS bağlantısı varsa sunucuya geri gönderilir.
	| Bu, güvenli bir şekilde yapılamazsa çerezin size gönderilmesini önleyecektir.
	|
	*/

    'secure' => env('SESSION_SECURE_COOKIE', null),
	
	/*
	|--------------------------------------------------------------------------
	| HTTP Access Only
	|--------------------------------------------------------------------------
	|
	| Bu değerin true olarak ayarlanması, JavaScript'in çerez değerine erişmesini önler ve
	| çerez sadece HTTP protokolü üzerinden erişilebilir.
	| Gerekirse bu seçeneği değiştirmekte özgürsünüz.
	|
	*/

    'http_only' => true,
	
	/*
	|--------------------------------------------------------------------------
	| Same-Site Cookies
	|--------------------------------------------------------------------------
	|
	| Bu seçenek, siteler arası istekler gerçekleştiğinde çerezlerinizin nasıl davranacağını belirler ve
	| CSRF saldırılarını azaltmak için kullanılabilir.
	| Varsayılan olarak, diğer CSRF koruma hizmetleri yerinde olduğundan bunu etkinleştirmiyoruz.
	|
	| Supported: "lax", "strict", "none"
	|
	*/

    'same_site' => 'lax',

];
