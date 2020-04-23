<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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
    Artisan::call('cache:forget spatie.permission.cache');
    
    // girilen değeri alma.
    $name = Str::studly($this->argument('name'));
    // gelen tüm değerleri array olarak alma
    $alreadyNames = ['User', 'Permission', 'Role', 'Image', 'Profile', 'Field', 'Module'];
    if ($name !== '' && !Module::find($name) && !in_array($name, $alreadyNames)) {
      // kaynak dosyası oluşturur.
      $this->source_generator($name);
      
      Artisan::call('module:make ' . $name);
      Artisan::call('module:make-model ' . $name . ' ' . $name);
      Artisan::call('module:make-migration create_' . $name . '_table ' . $name);
      Artisan::call('module:make-request Create' . $name . 'Request ' . $name);
      Artisan::call('module:make-request Update' . $name . 'Request ' . $name);
      
      // eğer daha önceden tablo oluşturulmuşsa migrate etme.
      if ( !Schema::hasTable($name)) Artisan::call('module:migrate ' . $name);
      
      $this->permission_generator($name);
      
      // burada bu json dosyasına gelen $name e göre yeni bir satır keyi eklenecek.
      $this->menu_generator($name);
    }
  }
  
  /**
   * @param $name
   * Burada oluşan yeni module için default bir source.json dosyası oluşuyor.
   */
  private function source_generator($name) : void
  {
    $source_path = storage_path('app\modules\sources');
    $default_source = json_decode(file_get_contents($source_path . '\default_source.json'), true);
    $default_source['titles'] = [
      'index' => "$name",
      'show' => "$name Detay",
      'create' => "$name Ekle",
      'edit' => "$name Düzenle",
    ];
    $lower_name = strtolower($name);
    $default_source['routes'] = [
      "index" => "$lower_name.index",
      "create" => "$lower_name.create",
      "store" => "$lower_name.store",
      "show" => "$lower_name.show",
      "edit" => "$lower_name.edit",
      "update" => "$lower_name.update",
      "delete" => "$lower_name.destroy",
    ];
    file_put_contents("$source_path\\$name.json", json_encode($default_source));
  }
  
  /**
   * @param $name
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
   * @param $name
   * Menuyü oluşturup json dosyasına yazar.
   */
  private function menu_generator($name) : void
  {
    \Illuminate\Support\Facades\Redis::del(config('cache.prefix') . ':menus');
    
    $menu_path = storage_path('app\public\application\settings\menu.json');
    $data = json_decode(file_get_contents($menu_path), true);
    $data[$name] = ['title' => $name, 'icon' => null];
    file_put_contents($menu_path, json_encode($data));
  }
}
