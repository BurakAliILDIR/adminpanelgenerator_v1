<?php

namespace App\Console\Commands;

use App\Traits\ConsoleTraits\ModuleCommandHelpers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;

class RemoveModule extends Command
{
  protected $signature = 'module:remove {name}';
  
  protected $description = 'Var olan modulü kaldırma.';
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function handle()
  {
    Artisan::call('cache:forget spatie.permission.cache');
  
    // girilen değeri alma.
    $name = $this->argument('name');
    if (($module = Module::find($name))) {
      // eğer daha önceden tablo oluşturulmuşsa migrate etme.
      if (Schema::hasTable($name)) {
        Artisan::call('module:migrate-reset ' . $name);
        
        $permissions = ['index', 'detail', 'create', 'update', 'delete'];
        foreach ($permissions as $permission) {
          (new Permission)->where(['name' => $name . '.' . $permission])->sharedLock()->delete();
        }
        
        $module->delete();
      }
    }
    
  }
}
