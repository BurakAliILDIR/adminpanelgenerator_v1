<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
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
	  Artisan::call('cache:forget ' . config('cache.prefix') . '.permission.cache');
	
	  // girilen değeri alma.
	  $lower_name = strtolower($this->argument('name'));
	  $name = Str::studly($lower_name);
	  // gelen tüm değerleri array olarak alma
	  $alreadyNames = ['User', 'Permission', 'Role', 'Image', 'Profile', 'Field', 'Module', 'SystemSettings'];
	  if ($name !== '' && !Module::find($name) && !in_array($name, $alreadyNames)) {
		  // kaynak dosyası oluşturur.
		  $this->source_generator($name);
		
		  Artisan::call("module:make $name");
		  Artisan::call("module:make-model $name $name");
		  Artisan::call("module:make-migration create_$lower_name" . "_table $name");
		  Artisan::call("module:make-request Create$name $name");
		  Artisan::call("module:make-request Update$name $name");
		
		  // eğer daha önceden tablo oluşturulmuşsa migrate etme.
		  if ( !Schema::hasTable($lower_name)) Artisan::call("module:migrate $lower_name");
		
		  $this->permission_generator($name);
		
		  // burada bu json dosyasına gelen $name e göre yeni bir satır keyi eklenecek.
		  $this->menu_generator($name);
		
		  Artisan::call('route:clear');
	  }
  }
  
  /**
   * @param $name
   * Burada oluşan yeni module için default bir source.json dosyası oluşuyor.
   */
  private function source_generator($name) : void
  {
    $source_path = storage_path('app/modules/sources');
    $default_source = json_decode(file_get_contents("$source_path/default_source.json"), true);
    $default_source['titles'] = [
      'index' => "$name",
      'show' => "$name Detay",
      'create' => "$name Ekle",
      'edit' => "$name Düzenle",
    ];
    $default_source['routes'] = [
      "index" => "$name.index",
      "create" => "$name.create",
      "store" => "$name.store",
      "show" => "$name.show",
      "edit" => "$name.edit",
      "update" => "$name.update",
      "delete" => "$name.destroy",
    ];
    file_put_contents("$source_path/$name.json", json_encode($default_source));
  }
  
  /**
   * Permission ları oluşturur.
   */
  private function permission_generator($name) : void
  {
    $permissions = ['index', 'detail', 'create', 'update', 'delete', 'imageUpload', 'imageDelete'];
    foreach ($permissions as $permission) {
      $p_name = $name . '.' . $permission;
      if ( !Permission::where('name', $p_name)->exists()) (new Permission)->create(['name' => $p_name]);
    }
  }
  
  /**
   * Menuyü oluşturup json dosyasına yazar.
   */
  private function menu_generator($name) : void
  {
	  Redis::del(config('cache.prefix') . ':menus');
    
    $menu_path = storage_path('app\public\application\settings\menu.json');
    $data = json_decode(file_get_contents($menu_path), true);
    $data[$name] = ['title' => $name, 'icon' => null];
    file_put_contents($menu_path, json_encode($data));
  }
}
