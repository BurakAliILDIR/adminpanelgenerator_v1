<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
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
	  Artisan::call('cache:forget ' . config('permission.cache.key'));
	
	  // girilen değeri alma.
	  $name = $this->argument('name');
	  $lower_name = strtolower($name);
	  if (($module = Module::find($name))) {
		  // eğer daha önceden tablo oluşturulmuşsa migrate etme.
		  if (Schema::hasTable($lower_name)) {
			  Artisan::call('module:migrate-reset ' . $lower_name);
			
			  $permissions = ['index', 'detail', 'create', 'update', 'delete', 'imageUpload', 'imageDelete'];
			  foreach ($permissions as $permission) (new Permission)->where(['name' => "$name.$permission"])->sharedLock()->delete();
		  }
		  $module->delete();
		
		  // burada bu json dosyasına gelen $name e göre menü alanı silinecek.
		  $menu_path = storage_path('app\public\application\settings\menu.json');
		  $data = json_decode(file_get_contents($menu_path), true);
		  foreach ($data as $key => $val) if ($key === $name) unset($data[$key]);
		  file_put_contents($menu_path, json_encode($data));
		
		  // Silinen modülün diğer json source lardaki ilişkili alanlarını silmektedir.
		  $source = json_decode(file_get_contents(storage_path("app/modules/sources/$name.json")), true);
		  foreach ($source['fields'] as $key => $val) {
        if (@$val['relationship']) {
          $json_path = storage_path("app/modules/sources/$key.json");
          if (($json = json_decode(file_get_contents($json_path), true))) {
            // eğer ortak bir tablo varsa (belongsToMany ise) 
            if (($drop_table_name = @$val['relationship']['keys']['table'])) {
              Schema::dropIfExists($drop_table_name);
            }
            unset($json['fields'][$name]);
            file_put_contents($json_path, json_encode($json));
          }
        }
      }
      
      Storage::delete("modules/sources/$name.json");
      Artisan::call('cache:clear');
    }
  }
}
