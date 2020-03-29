<?php


namespace App\Traits\ConsoleTraits;


use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Exceptions\FileAlreadyExistException;
use Nwidart\Modules\Generators\FileGenerator;

trait ModuleCommandHelpers
{
  private function appClear()
  {
    Artisan::call('cache:forget spatie.permission.cache');
/*    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize');*/
  }
  
}
