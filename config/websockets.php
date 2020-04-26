<?php

use BeyondCode\LaravelWebSockets\Dashboard\Http\Middleware\Authorize;

return [
  
  /*
   * Özel gösterge tablosu yapılandırması ayarlama
   */
  'dashboard' => [
    'port' => env('LARAVEL_WEBSOCKETS_PORT', 6001),
  ],
  
  /*
   * Bu paket, kutudan çıkar çıkmaz çoklu kiracılıkla birlikte gelir. 
   * Burada webSockets sunucusunu kullanabilen farklı uygulamaları yapılandırabilirsiniz.
   *
   * İsteğe bağlı olarak, belirli bir uygulama için maksimum eşzamanlı bağlantıyı 
   * sınırlayabilmeniz için kapasite belirtirsiniz.
   *
   * İsteğe bağlı olarak, istemci olaylarını devre dışı bırakabilirsiniz, 
   * böylece istemciler webSockets aracılığıyla birbirlerine mesaj gönderemezler.
   */
  'apps' => [
    [
      'id' => env('PUSHER_APP_ID'),
      'name' => env('APP_NAME'),
      'key' => env('PUSHER_APP_KEY'),
      'secret' => env('PUSHER_APP_SECRET'),
      'path' => env('PUSHER_APP_PATH'),
      'capacity' => null,
      'enable_client_messages' => false,
      'enable_statistics' => true,
    ],
  ],
  
  /*
   * Bu sınıf uygulamaları bulmaktan sorumludur. Varsayılan sağlayıcı,
   *  bu yapılandırma dosyasında tanımlanan uygulamaları kullanır.
   *
   * `AppProvider` arayüzünü uygulayarak özel bir sağlayıcı oluşturabilirsiniz.
   */
  'app_provider' => BeyondCode\LaravelWebSockets\Apps\ConfigAppProvider::class,
  
  /*
   * Bu dizi, gelen isteklere izin vermek istediğiniz ana bilgisayarları içerir.
   * Tüm toplantı sahiplerinden gelen istekleri kabul etmek istiyorsanız bunu boş bırakın.
   */
  'allowed_origins' => [
    //
  ],
  
  /*
   * Gelen bir WebSocket isteği için izin verilen maksimum kilobayt cinsinden istek boyutu.
   */
  'max_request_size_in_kb' => 250,
  
  /*
   * Bu yol, paket için gerekli yolları kaydetmek için kullanılacaktır.
   */
  'path' => 'websockets',
  
  /*
   * Dashboard Routes Middleware
   *
   * Bu ara katman yazılımı her gösterge tablosu rotasına atanır ve bu listeye kendi ara katman yazılımınızı ekleme veya 
   * mevcut ara katman yazılımlarından herhangi birini değiştirme şansı verir. Veya bu listeye sadık kalabilirsiniz.
   */
  'middleware' => [
    'web',
    Authorize::class,
    'verified',
  ],
  
  'statistics' => [
    /*
     * Bu model WebSocketsServer istatistiklerini saklamak için kullanılacaktır.
     * Tek şart, modelin bu paket tarafından sağlanan "WebSocketsStatisticsEntry" dosyasını genişletmesi gerektiğidir.
     */
    'model' => \BeyondCode\LaravelWebSockets\Statistics\Models\WebSocketsStatisticsEntry::class,
    
    /*
     * Burada, istatistiklerin günlüğe kaydedileceği aralığı saniye cinsinden belirleyebilirsiniz.
     */
    'interval_in_seconds' => 60,
    
    /*
     * clean-command yürütüldüğünde, burada belirtilen gün sayısından daha eski kaydedilmiş tüm istatistikler silinecektir.
     */
    'delete_statistics_older_than_days' => 30,
    
    /*
     * İstatistik günlükçüsüne yapılan istekleri varsayılan olarak her şeyi 127.0.0.1 olarak 
     * çözmek için bir DNS çözümleyici kullanın.
     */
    'perform_dns_lookup' => false,
  ],
  
  /*
   * WebSocket bağlantılarınız için isteğe bağlı SSL bağlamını tanımlayın.
   * Mevcut tüm seçenekleri şurada görebilirsiniz: http://php.net/manual/en/context.ssl.php
   */
  'ssl' => [
    /*
     * Dosya sistemindeki yerel sertifika dosyasının yolu. Sertifikanızı ve özel anahtarınızı içeren 
     * PEM kodlu bir dosya olmalıdır. İsteğe bağlı olarak ihraççıların sertifika zincirini içerebilir. 
     * Özel anahtar, local_pk tarafından belirtilen ayrı bir dosyada da bulunabilir.
     */
    'local_cert' => env('LARAVEL_WEBSOCKETS_SSL_LOCAL_CERT', null),
    
    /*
     * Sertifika (local_cert) ve özel anahtar için ayrı dosyalar olması durumunda dosya sistemindeki 
     * yerel özel anahtar dosyasının yolu.
     */
    'local_pk' => env('LARAVEL_WEBSOCKETS_SSL_LOCAL_PK', null),
    
    /*
     * Local_cert dosyanızın parolası.
     */
    'passphrase' => env('LARAVEL_WEBSOCKETS_SSL_PASSPHRASE', null),
  ],
  
  /*
   * Channel Manager
   * Bu sınıf kanal kalıcılığının nasıl işlendiğini ele alır.
   * Varsayılan olarak, kalıcılık çalışan web sunucusu tarafından bir dizide saklanır.
   * Tek gereksinim, sınıfın bu paket tarafından sağlanan `ChannelManager` arabirimini uygulamasıdır.
   */
  'channel_manager' => \BeyondCode\LaravelWebSockets\WebSockets\Channels\ChannelManagers\ArrayChannelManager::class,
];
