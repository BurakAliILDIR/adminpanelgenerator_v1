<?php

use Arcanedev\LogViewer\Contracts\Utilities\Filesystem;
use Illuminate\Support\Str;

return [
  
  /* -----------------------------------------------------------------
   |  Log files storage path
   | -----------------------------------------------------------------
   */
  
  'storage-path' => storage_path('logs'),
  
  /* -----------------------------------------------------------------
   |  Log files pattern
   | -----------------------------------------------------------------
   */
  
  'pattern' => [
	  'prefix' => config('cache.prefix'),    // 'laravel-'
	  'date' => Filesystem::PATTERN_DATE,      // '[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]'
	  'extension' => Filesystem::PATTERN_EXTENSION, // '.log'
  ],
  
  /* -----------------------------------------------------------------
   |  Locale
   | -----------------------------------------------------------------
   |  Supported locales :
   |    'auto', 'ar', 'bg', 'de', 'en', 'es', 'et', 'fa', 'fr', 'hu', 'hy', 'id', 'it', 'ja', 'ko', 'nl',
   |    'pl', 'pt-BR', 'ro', 'ru', 'sv', 'th', 'tr', 'zh-TW', 'zh'
   */
  
  'locale' => 'tr',
	
	/* -----------------------------------------------------------------
	 |  Theme
	 | -----------------------------------------------------------------
	 |  Supported themes :
	 |    'bootstrap-3', 'bootstrap-4'
	 |  Views dizinine bir klasör ekleyip burada belirterek kendi temanızı oluşturun.
	 */
  
  'theme' => 'bootstrap-4',
  
  /* -----------------------------------------------------------------
   |  Route settings
   | -----------------------------------------------------------------
   */
  
  'route' => [
    'enabled' => true,
    
    'attributes' => [
      'prefix' => 'error-logs',
      
      'middleware' => config('my-config.error_logviewer_middleware') ? explode(',', config('my-config.error_logviewer_middleware')) : null,
    ],
  ],
	
	/* -----------------------------------------------------------------
	 |  Log entries per page
	 | -----------------------------------------------------------------
	 |  Bu, sayfa başına kaç günlük ve giriş görüntüleneceğini tanımlar.
	 */
  
  'per-page' => 30,
  
  /* -----------------------------------------------------------------
   |  Download settings
   | -----------------------------------------------------------------
   */
  
  'download' => [
	  'prefix' => Str::camel(env('APP_NAME')),
	
	  'extension' => 'log',
  ],
  
  /* -----------------------------------------------------------------
   |  Menu settings
   | -----------------------------------------------------------------
   */
  
  'menu' => [
    'filter-route' => 'log-viewer::logs.filter',
    
    'icons-enabled' => true,
  ],
  
  /* -----------------------------------------------------------------
   |  Icons
   | -----------------------------------------------------------------
   */
  
  'icons' => [
    /**
     * Font awesome >= 4.3
     * http://fontawesome.io/icons/
     */
    'all' => 'fa fa-fw fa-list',                 // http://fontawesome.io/icon/list/
    'emergency' => 'fa fa-fw fa-bug',                  // http://fontawesome.io/icon/bug/
    'alert' => 'fa fa-fw fa-bullhorn',             // http://fontawesome.io/icon/bullhorn/
    'critical' => 'fa fa-fw fa-heartbeat',            // http://fontawesome.io/icon/heartbeat/
    'error' => 'fa fa-fw fa-times-circle',         // http://fontawesome.io/icon/times-circle/
    'warning' => 'fa fa-fw fa-exclamation-triangle', // http://fontawesome.io/icon/exclamation-triangle/
    'notice' => 'fa fa-fw fa-exclamation-circle',   // http://fontawesome.io/icon/exclamation-circle/
    'info' => 'fa fa-fw fa-info-circle',          // http://fontawesome.io/icon/info-circle/
    'debug' => 'fa fa-fw fa-life-ring',            // http://fontawesome.io/icon/life-ring/
  ],
  
  /* -----------------------------------------------------------------
   |  Colors
   | -----------------------------------------------------------------
   */
  
  'colors' => [
    'levels' => [
      'empty' => '#D1D1D1',
      'all' => '#8A8A8A',
      'emergency' => '#B71C1C',
      'alert' => '#D32F2F',
      'critical' => '#F44336',
      'error' => '#FF5722',
      'warning' => '#FF9100',
      'notice' => '#4CAF50',
      'info' => '#1976D2',
      'debug' => '#90CAF9',
    ],
  ],
  
  /* -----------------------------------------------------------------
   |  Strings to highlight in stack trace
   | -----------------------------------------------------------------
   */
  
  'highlight' => [
    '^#\d+',
    '^Stack trace:',
  ],

];
