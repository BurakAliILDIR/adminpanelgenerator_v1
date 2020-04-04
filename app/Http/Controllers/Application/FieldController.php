<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;

class FieldController extends Controller
{
  public function create($module_name)
  {
    return view('admin.application.module.create');
  }
  
  public function store(Request $request, $module_name)
  {
    Artisan::call("module:create $request->name");
    
    session()->flash('success', 'Modül başarıyla eklendi.');
    return redirect()->route('modules.index');
  }
  
  public function show($module_name, $key)
  {
    $module = Module::findOrFail($module_name);
    $path = storage_path("app\modules\sources\\$module_name.json");
    $fields = json_decode(file_get_contents($path), true)['fields'];
    return view('admin.application.field.index', compact('module', 'fields'));
  }
  
  public function edit($module_name, $key)
  {
    // TODO burada temel module özellikleri düzenlenecek. Fields lar için ayrı bir pencere açılacak
    $path = storage_path("app\modules\sources\\$module_name.json");
    $source = json_decode(file_get_contents($path), true);
    return view('admin.application.module.edit', compact('source', 'name'));
  }
  
  public function update(Request $request, $module_name, $key)
  {
    $path = storage_path("app\modules\sources\\$module_name.json");
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
    session()->flash('success', 'Modül başarıyla düzenlendi.');
    return redirect()->back();
  }
  
  public function destroy($module_name, $key)
  {
    $path = storage_path("app\modules\sources\\$module_name.json");
    $source = json_decode(file_get_contents($path), true);
    $fields = $source['fields'];
    unset($fields[$key]);
    $source['fields'] = $fields;
    file_put_contents($path, json_encode($source));
  
    session()->flash('danger', "$module_name modülündeki $key alanı silindi.");
    return redirect()->back();
  }
}
