<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;

class FieldController extends Controller
{
  public function create($module_name, $related = false)
  {
    if ($related) {
      
    } else {
      
    }
    $rules = ['required', 'accepted', 'alpha', 'alpha_num', 'array', 'boolean', 'image', 'email', 'nullable', 'file', 'string', 'phone:TR,AUTO'];
    $attributes = ['required' => 'required', 'autofocus' => 'autofocus', 'disabled' => 'disabled'];
    $pages = ['list', 'detail', 'create', 'update'];
    return view('admin.application.field.create', compact('module_name', 'pages', 'rules', 'attributes'));
  }
  
  public function store(Request $request, $module_name, $related = false)
  {
    $eleman = [
      'type' => $request['type'],
      'title' => $request['title'],
      'rules' => $request['rules'] ?? [],
      'attributes' => $request['attributes'] ?? [],
      'multiple' => false,
      'list' => in_array('list', $request['pages'] ?? []),
      'detail' => in_array('detail', $request['pages'] ?? []),
      'create' => in_array('create', $request['pages'] ?? []),
      'update' => in_array('update', $request['pages'] ?? []),
    ];
    if ($related) {
      
    } else {
      switch ($eleman['type']) {
        case 'image':
          $eleman['value'] = $request['values'];
          break;
        case 'multi_image':
          $eleman['count'] = $request['values'];
          $eleman['multiple'] = true;
          break;
        case 'radio':
          $eleman['items'] = explode("|", $request['values']);;
          break;
        case 'select':
          $eleman['value'] = explode("|", $request['values']);;
          break;
        case 'checkbox':
          $eleman['label'] = $request['values'];
          break;
      }
      //      $fields = array_merge(array_slice($fields, 0, $request['order']), [$eleman], array_slice($fields, $request['order']));
      $path = storage_path("app\modules\sources\\$module_name.json");
      $source = json_decode(file_get_contents($path), true);
      $fields = $source['fields'];
      $count = count($fields);
      $count = ($request['order'] > $count - 2) ? $count - 2 : $request['order'];
      
      // dizi elemanlarının arasına eleman sokuşturmak.
      $source['fields'] = array_slice($fields, 0, $count, true) + [$request['name'] => $eleman] +
        array_slice($fields, $count, count($fields) - 1, true);
      
      file_put_contents($path, json_encode($source));
    }
    session()->flash('success', 'Alan başarıyla eklendi.');
    return redirect()->route('modules.show', $module_name);
  }
  
  public function show($module_name, $key)
  {
    $path = storage_path("app\modules\sources\\$module_name.json");
    $field = json_decode(file_get_contents($path), true)['fields'][$key];
    return view('admin.application.field.show', compact('module_name', 'key', 'field'));
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
    if ( !($key !== 'id' && $key !== 'created_at' && $key !== 'updated_at')) return redirect()->route('modules.show', $module_name);
    $path = storage_path("app\modules\sources\\$module_name.json");
    $source = json_decode(file_get_contents($path), true);
    $fields = $source['fields'];
    unset($fields[$key]);
    $source['fields'] = $fields;
    file_put_contents($path, json_encode($source));
    
    session()->flash('danger', "$module_name modülündeki $key alanı silindi.");
    return redirect()->route('modules.show', $module_name);
  }
}
