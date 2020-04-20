<?php

return [
  
  /*
   * False değerine ayarlanırsa, veritabanına hiçbir etkinlik kaydedilmez.
   */
  'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),
  
  /*
   * Temizleme komutu yürütüldüğünde, burada belirtilen gün sayısından daha eski olan tüm kayıt etkinlikleri silinir.
   * 18250 = 50 Yıl 
  */
  'delete_records_older_than_days' => 18250,
  
  /*
   * activity() yardımcısına hiçbir günlük adı geçirilmezse, bu varsayılan günlük adını kullanırız.
   */
  'default_log_name' => 'default',
  
  /*
   * Burada kullanıcı modellerini alan bir yetkilendirme sürücüsü belirtebilirsiniz.
   * Bu boşsa, varsayılan Laravel kimlik doğrulama sürücüsünü kullanacağız.
   */
  'default_auth_driver' => null,
  
  /*
   * True olarak ayarlanırsa, nesne yumuşak silinen modelleri döndürür.
   */
  'subject_returns_soft_deleted_models' => false,
  
  /*
   * Bu model etkinliği günlüğe kaydetmek için kullanılacaktır.
   * It should be implements the Spatie\Activitylog\Contracts\Activity interface
   * and extend Illuminate\Database\Eloquent\Model.
   */
  'activity_model' => \Spatie\Activitylog\Models\Activity::class,
  
  /*
   * Bu, taşıma işlemi tarafından oluşturulacak ve bu paketle birlikte gönderilen 
   * Activity modeli tarafından kullanılacak tablonun adıdır.
   */
  'table_name' => 'activity_log',
  
  /*
   * Bu, geçiş ve bu paketle birlikte gönderilen Etkinlik modeli tarafından kullanılacak veritabanı bağlantısıdır. 
   * Ayarlanmadıysa bunun yerine Laravel database.default kullanılır.     
   */
  'database_connection' => env('ACTIVITY_LOGGER_DB_CONNECTION'),
];
