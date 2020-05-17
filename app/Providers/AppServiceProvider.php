<?php

namespace App\Providers;

use App\Models\SystemSettings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Tüm uygulama hizmetlerini kaydedin.
   * @return void
   */
  public function register()
  {
    //
  }
  
  /**
   * Herhangi bir uygulama hizmetini önyükleyin.
   * @return void
   */
  public function boot()
  {
	  Schema::defaultStringLength(191);
  }
}
