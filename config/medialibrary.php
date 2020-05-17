<?php

return [
	
	/*
	 * Varsayılan olarak eklenen dosyaların ve türetilmiş görüntülerin depolanacağı disk.
	 * config/filesystems.php içinde yapılandırdığınız bir veya daha fazla diski seçin.
	 */
	'disk_name' => env('MEDIA_DISK', 'public'),
	
	/*
	 * Bir öğenin bayt cinsinden maksimum dosya boyutu.
	 * Daha büyük bir dosya eklemek istisnayla sonuçlanır.
	 */
	'max_file_size' => 1024 * 1024 * 10,
	
	/*
	 * Bu kuyruk türetilmiş ve duyarlı görüntüler oluşturmak için kullanılacaktır.
	 * Varsayılan kuyruğu kullanmak için boş bırakın.
	 */
	'queue_name' => '',
	
	/*
	 * Medya modelinin tam sınıf adı.
	 */
	'media_model' => Spatie\MediaLibrary\Models\Media::class,
	
	's3' => [
		/*
		 * URL oluşturulurken eklenmesi gereken alan.
		 */
		'domain' => 'https://' . env('AWS_BUCKET') . '.s3.amazonaws.com',
	],
	
	'remote' => [
		/*
		 * Uzak bir diske ortam yüklerken eklenmesi gereken ek başlıklar.
		 * Desteklenen üstbilgiler farklı sürücüler arasında değişiklik gösterse de,
		 * makul bir varsayılan değer sağlanmıştır.
		 *
		 * Supported by S3: CacheControl, Expires, StorageClass,
		 * ServerSideEncryption, Metadata, ACL, ContentEncoding
		 */
		'extra_headers' => [
			'CacheControl' => 'max-age=604800',
		],
	],

    'responsive_images' => [
	
	    /*
			 * Bu sınıf, duyarlı görüntülerin hedef genişliklerinin hesaplanmasından sorumludur.
			 * Varsayılan olarak, dosya boyutunu optimize eder ve her birinin öncekinden %20 daha küçük varyasyonlar oluştururuz.
			 * Belgelerde daha fazla bilgi.
			 *
			 * https://docs.spatie.be/laravel-medialibrary/v7/advanced-usage/generating-responsive-images
			 */
	    'width_calculator' => Spatie\MediaLibrary\ResponsiveImages\WidthCalculator\FileSizeOptimizedWidthCalculator::class,
	
	    /*
			 * Varsayılan olarak, duyarlı bir görüntüye ortam oluşturma, bazı javascript ve küçük bir yer tutucu ekler.
			 * Bu, tarayıcının doğru düzeni zaten belirleyebilmesini sağlar.
			 */
	    'use_tiny_placeholders' => true,
	
	    /*
			 * Bu sınıf, aşamalı görüntü yükleme için kullanılan küçük yer tutucuyu oluşturur. 
			 * Varsayılan olarak medialibrary küçük bir bulanık jpg görüntüsü kullanacaktır.
			 */
	    'tiny_placeholder_generator' => Spatie\MediaLibrary\ResponsiveImages\TinyPlaceholderGenerator\Blurred::class,
    ],
	
	/*
	 * Dosyalara URL'ler oluşturulduğunda bu sınıf çağrılır. 
	 * Dosyalarınız site kökünün üstünde yerel olarak veya s3'te depolanmışsa boş bırakın.
	 */
	'url_generator' => null,
	
	/*
	 * Dosyalara URL'ler oluşturulduğunda sürümün etkinleştirilip etkinleştirilmeyeceği.
	 * Etkinleştirildiğinde, URL'ye ?v=xx sorgu dizesi eklenir.
	 */
	'version_urls' => false,
	
	/*
	 * Bir medya dosyasının yolunu belirleme stratejisini içeren sınıf.
	 */
	'path_generator' => null,
	
	/*
	 * Medialibrary, meta verileri kaldırarak ve biraz sıkıştırma uygulayarak dönüştürülen 
	 * tüm görüntüleri optimize etmeye çalışacaktır. 
	 * Bunlar varsayılan olarak kullanılacak optimize edicilerdir.
	 */
	'image_optimizers' => [
		Spatie\ImageOptimizer\Optimizers\Jpegoptim::class => [
			'--strip-all', // this strips out all text information such as comments and EXIF data
			'--all-progressive', // this will make sure the resulting image is a progressive one
		],
		Spatie\ImageOptimizer\Optimizers\Pngquant::class => [
			'--force', // required parameter for this package
		],
		Spatie\ImageOptimizer\Optimizers\Optipng::class => [
			'-i0', // this will result in a non-interlaced, progressive scanned image
            '-o2', // this set the optimization level to two (multiple IDAT compression trials)
			'-quiet', // required parameter for this package
		],
		Spatie\ImageOptimizer\Optimizers\Svgo::class => [
			'--disable=cleanupIDs', // disabling because it is known to cause troubles
		],
		Spatie\ImageOptimizer\Optimizers\Gifsicle::class => [
			'-b', // required parameter for this package
			'-O3', // this produces the slowest but best results
		],
	],
	
	/*
	 * Bu jeneratörler medya dosyalarının bir görüntüsünü oluşturmak için kullanılacaktır.
	 */
	'image_generators' => [
		Spatie\MediaLibrary\ImageGenerators\FileTypes\Image::class,
		Spatie\MediaLibrary\ImageGenerators\FileTypes\Webp::class,
		Spatie\MediaLibrary\ImageGenerators\FileTypes\Pdf::class,
		Spatie\MediaLibrary\ImageGenerators\FileTypes\Svg::class,
		Spatie\MediaLibrary\ImageGenerators\FileTypes\Video::class,
	],
	
	/*
	 * Görüntü dönüşümlerini gerçekleştirmesi gereken motor.
	 * Should be either `gd` or `imagick`.
	 */
	'image_driver' => env('IMAGE_DRIVER', 'imagick'),
	
	/*
	 * FFMPEG & FFProbe ikili yollar, yalnızca video oluşturmaya çalışırsanız kullanılır
	 * ve php-ffmpeg/php-ffmpeg besteci bağımlılığını yükledik.
	 */
	'ffmpeg_path' => env('FFMPEG_PATH', '/usr/bin/ffmpeg'),
	'ffprobe_path' => env('FFPROBE_PATH', '/usr/bin/ffprobe'),
	
	/*
	 * Görüntü dönüşümleri yaparken geçici dosyaların depolanacağı yol.
	 * Null değerine ayarlanırsa, storage_path('medialibrary/temp') kullanılır.
	 */
	'temporary_directory_path' => null,
	
	/*
	 * Burada bu paket tarafından kullanılan işlerin sınıf adlarını geçersiz kılabilirsiniz. 
	 * Özel işlerinizin paket tarafından sağlanan işleri genişlettiğinden emin olun.
	 */
	'jobs' => [
		'perform_conversions' => Spatie\MediaLibrary\Jobs\PerformConversions::class,
		'generate_responsive_images' => Spatie\MediaLibrary\Jobs\GenerateResponsiveImages::class,
	],
];
