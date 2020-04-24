<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Traits\DangerStatusTraits\DangerStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;

class ModuleController extends Controller
{
  use DangerStatusTrait;
  
  public function __construct()
  {
    Artisan::call('cache:clear');
  }
  
  public function index()
  {
    $this->dangerStatusMailSend('ModuleController-index');
    
    $data = Module::all();
    return view('admin.application.module.index', compact('data'));
  }
  
  public function create()
  {
    return view('admin.application.module.create');
  }
  
  public function store(Request $request)
  {
    $this->dangerStatusMailSend('ModuleController-store', "$request->name modülü eklendi.");
    
    $name = Str::studly($request->name);
    Artisan::call("module:create $name");
    $result = Artisan::output();
    
    if ($result == "The [spatie.permission.cache] key has been removed from the cache.\n\r")
      session()->flash('danger', 'Lütfen geçerli bir modül adı giriniz.');
    else
      session()->flash('info', 'Modül başarıyla oluşturuldu.');
    
    return redirect()->route('modules.index');
  }
  
  public function show($name)
  {
    $this->dangerStatusMailSend('ModuleController-show (Alanlar listesi)', $name);
    
    $module = Module::findOrFail($name);
    $path = storage_path("app\modules\sources\\$name.json");
    $fields = json_decode(file_get_contents($path), true)['fields'];
    return view('admin.application.field.index', compact('module', 'fields'));
  }
  
  public function edit($name)
  {
    $path = storage_path("app\modules\sources\\$name.json");
    $source = json_decode(file_get_contents($path), true);
    
    // menü bilgisi getirme
    $menu_path = storage_path('app\public\application\settings\menu.json');
    $menu = json_decode(file_get_contents($menu_path), true)[$name];
    
    return view('admin.application.module.edit', compact('source', 'name', 'menu'));
  }
  
  public function update(Request $request, $name)
  {
    $path = storage_path("app\modules\sources\\$name.json");
    $source = json_decode(file_get_contents($path), true);
    
    $source['paginate'] = $request->paginate;
    $source['searchable'] = $request->searchable;
    $source['slugs'] = $request->slugs;
    $source['titles'] = [
      'index' => "$request->index",
      'show' => "$request->show",
      'create' => "$request->create",
      'edit' => "$request->edit",
    ];
    
    file_put_contents($path, json_encode($source));
    
    // menü güncelleme
    \Illuminate\Support\Facades\Redis::del(config('cache.prefix') . ':menus');
    
    $menu_path = storage_path('app\public\application\settings\menu.json');
    $menus = json_decode(file_get_contents($menu_path), true);
    $menus[$name] = ['title' => $request['menu_title'], 'icon' => $request['menu_icon']];
    file_put_contents($menu_path, json_encode($menus));
    
    session()->flash('info', 'Modül başarıyla düzenlendi.');
    return redirect()->back();
  }
  
  public function destroy($name)
  {
    Artisan::call("module:remove $name");
    session()->flash('danger', "$name modülü silindi.");
    return redirect()->back();
  }
  
  public function migrate_refresh($name = null)
  {
    Artisan::call('lada-cache:flush');
    if ($name) {
      Artisan::call("module:migrate-refresh $name");
      session()->flash('info', "$name modülü sıfırlandı.");
    } else {
      Artisan::call("build");
      session()->flash('info', "Sistem sıfırlandı.");
    }
    return redirect()->back();
  }
}
