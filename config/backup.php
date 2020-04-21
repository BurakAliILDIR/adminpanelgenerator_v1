<?php

$app_name = Illuminate\Support\Str::slug(env('APP_NAME', 'laravel'), '_');

return [
  
  'backup' => [
    
    /*
     * Bu uygulamanın adı. Yedekleri izlemek için bu adı kullanabilirsiniz.
     */
    'name' => $app_name,
    
    'source' => [
      
      'files' => [
        
        /*
         * Yedeklemeye eklenecek dizinlerin ve dosyaların listesi.
         */
        'include' => [
          storage_path(),
        ],
        
        /*
         * Bu dizinler ve dosyalar yedeklemenin dışında bırakılır.
         *
         * Yedekleme işlemi tarafından kullanılan dizinler otomatik olarak hariç tutulur.
         */
        'exclude' => [
          base_path('vendor'),
          base_path('node_modules'),
        ],
        
        /*
         * Simgelerin izlenip izlenmeyeceğini belirler.
         */
        'follow_links' => false,
      ],
      
      /*
       * MySQL, PostgreSQL, SQLite ve Mongodb veritabanlarının yedeklenmesi gereken veritabanlarına
       * bağlantıların adları desteklenir.
       *
       * Veritabanı dökümünün içeriği, config/database.php dosyasındaki bağlantı ayarlarına bir 'dump'
       * anahtarı eklenerek her bağlantı için özelleştirilebilir.
       * E.g.
       * 'mysql' => [
       *       ...
       *      'dump' => [
       *           'excludeTables' => [
       *                'table_to_exclude_from_backup',
       *                'another_table_to_exclude'
       *            ]
       *       ],
       * ],
       *
       * Bir MySQL sunucusunda yalnızca InnoDB tablolarını kullanıyorsanız, tablo kilitlemesini önlemek için
       * useSingleTransaction seçeneğini de sağlayabilirsiniz.
       *
       * E.g.
       * 'mysql' => [
       *       ...
       *      'dump' => [
       *           'useSingleTransaction' => true,
       *       ],
       * ],
       *
       * Mevcut özelleştirme seçeneklerinin tam listesi için, see https://github.com/spatie/db-dumper
       */
      'databases' => [
        'mysql',
      ],
    ],
    
    /*
     * Veritabanı dökümü, disk alanı kullanımını azaltmak için sıkıştırılabilir.
     *
     * Veritabanı dökümü, disk alanı kullanımını azaltmak için sıkıştırılabilir....
     * Spatie\DbDumper\Compressors\GzipCompressor::class.
     *
     * Özel kompresör de oluşturabilirsiniz. Burada daha fazla bilgi:
     * https://github.com/spatie/db-dumper#using-compression
     *
     * Hiç kompresör istemiyorsanız, null değerine ayarlayın.
     */
    'database_dump_compressor' => null,
    
    'destination' => [
      
      /*
       * Yedek zip dosyası için kullanılan dosya adı öneki.
       */
      'filename_prefix' => $app_name,
      
      /*
       * Yedeklemelerin saklanacağı disk adları.
       */
      'disks' => [
        'local',
      ],
    ],
    
    /*
     * Geçici dosyaların saklanacağı dizin.
     */
    'temporary_directory' => storage_path('app/backup-temp'),
  ],
  
  /*
   * Belirli olaylar meydana geldiğinde bildirim alabilirsiniz. Kutunun dışında 'mail' ve 'slack' kullanabilirsiniz.
   * Slack için guzzlehttp/guzzle ve laravel/slack-notification-channel kurmanız gerekir.
   * Kendi bildirim sınıflarınızı da kullanabilirsiniz, sınıfın adlarından birinin
   * the `Spatie\Backup\Events` classes.
   */
  'notifications' => [
    // default mail | slack geldi yerine.
    'notifications' => [
      \Spatie\Backup\Notifications\Notifications\BackupHasFailed::class => ['mail'],
      \Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFound::class => ['mail'],
      \Spatie\Backup\Notifications\Notifications\CleanupHasFailed::class => ['mail'],
      \Spatie\Backup\Notifications\Notifications\BackupWasSuccessful::class => ['mail'],
      \Spatie\Backup\Notifications\Notifications\HealthyBackupWasFound::class => ['mail'],
      \Spatie\Backup\Notifications\Notifications\CleanupWasSuccessful::class => ['mail'],
    ],
    
    /*
     * Burada bildirimlerin gönderileceği bildirimi belirtebilirsiniz. 
     * Varsayılan bildirim, bu yapılandırma dosyasında belirtilen değişkenleri kullanır.
     * // TODO : YEDEK Bildirimleri gönderimi.
     */
    'notifiable' => \Spatie\Backup\Notifications\Notifiable::class,
    
    'mail' => [
      'to' => env('BACKUP_NOTIFICATION_MAIL', 'TheNobleBrain@gmail.com'),
      
      'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'example@example.com'),
        'name' => env('MAIL_FROM_NAME', 'example'),
      ],
    ],
    
    'slack' => [
      'webhook_url' => '',
      
      /*
       * Bu null değerine ayarlanırsa, web kancasının varsayılan kanalı kullanılır.
       */
      'channel' => '#channel-name',
      
      'username' => 'username',
      
      'icon' => null,
    
    ],
  ],
  
  
  /*
   * Burada hangi yedeklemelerin izleneceğini belirleyebilirsiniz.
   * Bir yedekleme belirtilen gereksinimleri karşılamıyorsa, UnHealthyBackupWasFound olayı tetiklenir.
   */
  'monitor_backups' => [
    [
      'name' => env('APP_NAME', 'laravel-backup'),
      'disks' => ['local'],
      'health_checks' => [
        \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumAgeInDays::class => 1,
        \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumStorageInMegabytes::class => 5000,
      ],
    ],
    
    /*
    [
        'name' => 'name of the second app',
        'disks' => ['local', 's3'],
        'health_checks' => [
            \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumAgeInDays::class => 1,
            \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumStorageInMegabytes::class => 5000,
        ],
    ],
    */
  ],
  
  'cleanup' => [
    /*
     * Eski yedeklemeleri temizlemek için kullanılacak strateji. 
     * Varsayılan strateji, tüm yedeklemeleri belirli bir gün boyunca tutacaktır. 
     * Bu süreden sonra yalnızca günlük bir yedek tutulur. Bu süreden sonra yalnızca haftalık 
     * yedekler saklanacaktır.
     *
     * Nasıl yapılandırırsanız yapın, varsayılan strateji hiçbir zaman en yeni yedeklemeyi silmez.
     */
    'strategy' => \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,
    
    'default_strategy' => [
      
      /*
       * Yedeklemelerin tutulacağı gün sayısı.
       */
      'keep_all_backups_for_days' => 7,
      
      /*
       * Günlük yedeklemelerin tutulacağı gün sayısı.
       */
      'keep_daily_backups_for_days' => 16,
      
      /*
       * Bir haftalık yedeklemenin tutulması gereken hafta sayısı.
       */
      'keep_weekly_backups_for_weeks' => 8,
      
      /*
       * Aylık yedeklemenin tutulması gereken ay sayısı.
       */
      'keep_monthly_backups_for_months' => 4,
      
      /*
       * Bir yıllık yedeklemenin tutulması gereken yıl sayısı.
       */
      'keep_yearly_backups_for_years' => 1000,
      
      /*
       * Yedekleri temizledikten sonra, bu megabayta ulaşılana kadar en eski yedeklemeyi kaldırın.
       */
      'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
    ],
  ],

];
