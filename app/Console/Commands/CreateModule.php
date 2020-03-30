<?php

namespace App\Console\Commands;

use App\Traits\ConsoleTraits\ModuleCommandHelpers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;

class CreateModule extends Command
{
  protected $signature = 'module:create {name}';
  
  protected $description = 'Yeni bir module oluşturma.';
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function handle()
  {
    Artisan::call('cache:forget spatie.permission.cache');
    
    // girilen değeri alma.
    $name = $this->argument('name');
    // gelen tüm değerleri array olarak alma
    if ( !Module::find($name)) {
      Artisan::call('module:make ' . $name);
      Artisan::call('module:make-model ' . $name . ' ' . $name);
      Artisan::call('module:make-migration create_' . $name . '_table ' . $name);
      // php artisan module:make-migration create_posts_table Blog
      Artisan::call('module:make-request Create' . $name . 'Request ' . $name);
      Artisan::call('module:make-request Update' . $name . 'Request ' . $name);
      
      // eğer daha önceden tablo oluşturulmuşsa migrate etme.
      if ( !Schema::hasTable($name)) {
        Artisan::call('module:migrate ' . $name);
      }
    }
    $permissions = ['index', 'detail', 'create', 'update', 'delete', 'imageUpload', 'imageDelete'];
    foreach ($permissions as $permission) {//
      $p_name = $name . '.' . $permission;
      if ( !Permission::where('name', $p_name)->exists()) {
        (new Permission)->create(['name' => $p_name]);
      }
    }
  }
}
