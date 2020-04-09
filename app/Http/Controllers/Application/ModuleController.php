<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;

class ModuleController extends Controller
{
  public function index()
  {
    $data = Module::all();
    return view('admin.application.module.index', compact('data'));
  }
  
  public function create()
  {
    return view('admin.application.module.create');
  }
  
  public function store(Request $request)
  {
    Artisan::call("module:create $request->name");
    
    session()->flash('success', 'Modül başarıyla eklendi.');
    return redirect()->route('modules.index');
  }
  
  public function show($name)
  {
    $module = Module::findOrFail($name);
    $path = storage_path("app\modules\sources\\$name.json");
    $fields = json_decode(file_get_contents($path), true)['fields'];
    return view('admin.application.field.index', compact('module', 'fields'));
  }
  
  public function edit($name)
  {
    // TODO burada temel module özellikleri düzenlenecek. Fields lar için ayrı bir pencere açılacak
    $path = storage_path("app\modules\sources\\$name.json");
    $source = json_decode(file_get_contents($path), true);
    return view('admin.application.module.edit', compact('source', 'name'));
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
    session()->flash('info', 'Modül başarıyla düzenlendi.');
    return redirect()->back();
  }
  
  public function destroy($name)
  {
    // TODO : Modülün json dosyasını oluşturmak için bir yol bulunacak. 
    Artisan::call("module:remove $name");
    session()->flash('danger', "$name modülü silindi.");
    return redirect()->back();
  }
}
