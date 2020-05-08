<?php

return [
  
  /**
   * Bir ElasticSearch istemcisi oluştururken birkaç farklı bağlantıdan birini belirtebilirsiniz.
   * Burada, bir istemci oluştururken aşağıdaki bağlantılardan hangisini varsayılan bağlantınız olarak kullanmak
   * istediğinizi belirtebilirsiniz. Tabii ki, her biri farklı konfigürasyonlara sahip birden fazla istemci
   * oluşturmak için kullanabilirsiniz.
   */
  
  'defaultConnection' => 'default',
  
  /**
   * Bunlar, istemci oluşturulurken kullanılan bağlantı parametreleridir.
   */
  
  'connections' => [
    
    'default' => [
      
      /**
       * Hosts
       * Bu, istemcinin bağlanacağı bir ana bilgisayar dizisidir.
       * Tek bir ana bilgisayar veya bir ElasticSearch örnekleri kümesi çalıştırıyorsanız bir dizi olabilir.
       * Zorunlu olan tek yapılandırma değeri budur.
       * Şu anda "extended" ana makine yapılandırma yöntemini kullanarak
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_extended_host_configuration
       * Daha kısa "inline" yapılandırma yöntemi de mevcuttur
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_inline_host_configuration
       */
      
      'hosts' => [
        [
          'host' => env('ELASTICSEARCH_HOST', 'localhost'),
          'port' => env('ELASTICSEARCH_PORT', 9200),
          'scheme' => env('ELASTICSEARCH_SCHEME', null),
          'user' => env('ELASTICSEARCH_USER', null),
          'pass' => env('ELASTICSEARCH_PASS', null),
          
          // AWS'de bir ElasticSearch örneğine bağlanıyorsanız, bu değerlere de ihtiyacınız olacaktır
          'aws' => env('AWS_ELASTICSEARCH_ENABLED', false),
          'aws_region' => env('AWS_REGION', ''),
          'aws_key' => env('AWS_ACCESS_KEY_ID', ''),
          'aws_secret' => env('AWS_SECRET_ACCESS_KEY', ''),
          'aws_credentials' => null,
        ],
      ],
      
      /**
       * SSL
       * ElasticSearch örneğinizde geçmiş veya kendinden imzalı bir SSL sertifikası kullanılıyorsa,
       * sertifika paketini iletmeniz gerekir. Bu, sertifika dosyasının yolu
       * (kendinden imzalı sertifikalar için) veya https://github.com/Kdyby/CurlCaBundle
       * gibi bir paket olabilir. Tüm ayrıntılar için aşağıdaki belgelere bakın.
       * SSL örnekleri kullanıyorsanız ve sertifikalar güncel ve genel sertifika yetkilisi tarafından
       * imzalanmışsa, bu null değerini bırakıp yukarıdaki ana makine yollarında "https"
       * kullanabilirsiniz ve iyi olmalısınız.
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_security.html#_ssl_encryption_2
       */
      
      'sslVerification' => null,
      
      /**
       * Logging
       * Günlük tutma, Monolog\Logger'ın (Laravel'in varsayılan günlükçüsünün tesadüf eseri olan)
       * bir örneğinden geçirilerek işlenir.
       * Günlüğe kaydetme etkinleştirilirse, yolu ve günlük düzeyini ayarlamanız gerekir
       * (bazı varsayılanlar aşağıda verilmiştir) veya Psr\Log\LoggerInterface örneğine
       * 'logObject' ayarlayarak özel bir günlük kaydedici kullanabilirsiniz.
       * Aslında, sadece varsayılan Laravel logger'ı kullanmak istiyorsanız, 'logObject'
       * seçeneğini \Log::getMonolog() olarak ayarlayın.
       * Not: 'logObject', 'logPath'/'logLevel' üzerinde emsal teşkil eder,
       * bu nedenle yalnızca log tabanlı bir özel yola gitmek istiyorsanız 'logObject'
       * null değerini ayarlayın.
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#enabling_logger
       */
      
      'logging' => false,
      
      // Mevcut bir Monolog örneğiniz varsa burada kullanabilirsiniz.
      // 'logObject' => \Log::getMonolog(),
      
      'logPath' => storage_path('logs/elasticsearch.log'),
      
      'logLevel' => Monolog\Logger::INFO,
      
      /**
       * Retries
       * Varsayılan olarak, istemci n kez yeniden dener; burada n = kümenizdeki düğüm sayısı.
       * Yeniden denemeleri devre dışı bırakmak veya numarayı değiştirmek isterseniz,
       * bunu burada yapabilirsiniz.
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_set_retries
       */
      
      'retries' => null,
      
      /**
       * Yapılandırma seçeneklerinin geri kalanı, bunları değiştirmek için belirli
       * nedenleriniz olmadıkça neredeyse her zaman olduğu gibi bırakılabilir.
       * Her seçeneğin ne yaptığını ve hangi değerleri beklediğini öğrenmek için
       * ElasticSearch belgelerindeki uygun bölümlere bakın.
       */
      
      /**
       * Sniff On Start
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html
       */
      
      'sniffOnStart' => false,
      
      /**
       * HTTP Handler
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_configure_the_http_handler
       * @see http://ringphp.readthedocs.org/en/latest/client_handlers.html
       */
      
      'httpHandler' => null,
      
      /**
       * Connection Pool
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_the_connection_pool
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_connection_pool.html
       */
      
      'connectionPool' => null,
      
      /**
       * Connection Selector
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_the_connection_selector
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_selectors.html
       */
      
      'connectionSelector' => null,
      
      /**
       * Serializer
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_the_serializer
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_serializers.html
       */
      
      'serializer' => null,
      
      /**
       * Connection Factory
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_a_custom_connectionfactory
       */
      
      'connectionFactory' => null,
      
      /**
       * Endpoint
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/6.0/_configuration.html#_set_the_endpoint_closure
       */
      
      'endpoint' => null,
      
      
      /**
       * Register additional namespaces
       * Kaydedilecek ek ad alanları dizisi.
       * @example 'namespaces' => [XPack::Security(), XPack::Watcher()]
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/ElasticsearchPHP_Endpoints.html#Elasticsearch_ClientBuilderregisterNamespace_registerNamespace
       */
      'namespaces' => [],
      
      /**
       * Tracer
       * İzleyici, sınıf uygulayıcılarının bir ismini ileterek ele alınır. Psr\Log\LoggerInterface.
       * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/_configuration.html#_setting_a_custom_connectionfactory
       */
      'tracer' => null,
    
    ],
  
  ],

];
