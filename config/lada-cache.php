<?php

return [
  
  /*
  |--------------------------------------------------------------------------
  | Önbelleği devre dışı bırakma
  |--------------------------------------------------------------------------
  |
  | Bu değer false olarak ayarlandığında önbellek tamamen devre dışı bırakılır.
  | Bu hata ayıklama amaçları için yararlı olabilir.
  |                                                            
  kapatmak için:
  'active' => env('LADA_CACHE_ACTIVE', true),

  */
  'active' => env('LADA_CACHE_ACTIVE', true),
  
  /*
  |--------------------------------------------------------------------------
  | Redis öneki
  |--------------------------------------------------------------------------
  |
  | Bu önek, Redis mağazasındaki tüm öğelere eklenecektir.
  | Üretimde bu değeri değiştirmeyin, beklenmedik davranışlara neden olacaktır.
  |
  */
  'prefix' => env('CACHE_PREFIX', Illuminate\Support\Str::slug(env('APP_NAME', 'laravel'), '_') . '_cache:'),
  
  /*
  |--------------------------------------------------------------------------
  | Son kullanma tarihi
  |--------------------------------------------------------------------------
  |
  | Varsayılan olarak, bu değer null olarak ayarlanırsa, önbelleğe alınan öğelerin süresi asla dolmaz.
  | Ölü verilerden korkuyorsanız veya disk alanını önemsiyorsanız, bu değeri 604800 (7 gün = 3600 * 24 * 7) gibi bir değere ayarlamak iyi bir fikir olabilir.
  |
  */
  'expiration-time' => 3600,
  
  /*
  |--------------------------------------------------------------------------
  | Önbellek ayrıntı düzeyi
  |--------------------------------------------------------------------------
  |
  | Önbelleği kullanırken herhangi bir sorunla karşılaşırsanız, bu değeri false olarak ayarlamayı deneyin.
  | Bu, önbelleğe daha düşük bir ayrıntı düzeyi kullanmasını söyler ve bir veritabanı sorgusu için etiketleri oluştururken
  | satır birincil anahtarlarını dikkate almaz. Bu, önbelleğin verimliliğini önemli ölçüde azaltacağından,
  | üretim ortamında yapılması önerilmez.
  |
  */
  'consider-rows' => true,
  
  
  /*
  |--------------------------------------------------------------------------
  | Tabloları dahil et
  |--------------------------------------------------------------------------
  |
  | Yalnızca belirli tabloları önbelleğe almak istiyorsanız, tablo adlarını bu diziye yerleştirin. 
  | Daha sonra sorgu burada belirtilmeyen bir tablo içerdiğinde önbelleğe alınmaz. Bu özelliği etkinleştirdiyseniz,
  | "exclude-tables" değeri göz ardı edilir ve hiçbir etkisi olmaz.
  | 
  | Yapılandırmadaki sabit kodlama tablosu isimleri yerine, iyi bir
  | Aşağıdaki örnekte olduğu gibi yeni bir model örneği başlatma ve tablo adını oradan alma alıştırması:
  | 
  | 'include-tables' => [
  |     (new \App\Models\User())->getTable(),
  |     (new \App\Models\Post())->getTable(),
  | ],
  |
  */
  'include-tables' => [],
  
  /*
  |--------------------------------------------------------------------------
  | Tabloları hariç tutma
  |--------------------------------------------------------------------------
  |
  | Bazı tablolar hariç tüm tabloları önbelleğe almak istiyorsanız, bunları bu diziye koyun.
  | Bir sorgu burada belirtilen en az bir etiket içerdiğinde önbelleğe alınmaz.
  |
  */
  'exclude-tables' => [],
];
