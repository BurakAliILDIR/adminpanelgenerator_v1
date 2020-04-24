<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Traits\DangerStatusTraits\DangerStatusTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;

class FieldController extends Controller
{
  use DangerStatusTrait;
  
  public function __construct()
  {
    Artisan::call('cache:clear');
  }
  
  public function create($module_name, $related = false)
  {
    $rules = $this->getRules();
    $attributes = $this->getAttributes();
    $pages = $this->getPages();
    if ($related) {
      $types = ['select' => 'Select', 'multi_select' => 'Multi Select', 'multi_checkbox' => 'Multi CheckBox',];
      $relationships = ['hasOne' => 'HasOne', 'hasMany' => 'HasMany', 'belongsTo' => 'BelongsTo', 'belongsToMany' => 'BelongsToMany',];
      $models['App\\Models\\User'] = 'User';
      
      foreach (Module::all() as $module) {
        $m_name = $module->getName();
        $m_path = "Modules\\$m_name\\Models\\$m_name";
        $models[$m_path] = $m_name;
      }
      $this_fields = json_decode(file_get_contents(storage_path("app\modules\sources\\$module_name.json")), true)['fields'];
      return view('admin.application.field.related_create', compact('module_name', 'pages', 'rules', 'attributes', 'types', 'models', 'relationships', 'this_fields'));
    } else {
      $types = ['text' => 'Text', 'number' => 'Integer', 'decimal' => 'Decimal', 'textarea' => 'Textarea', 'radio' => 'Radio Button', 'checkbox' => 'CheckBox (true, false)',
        'select' => 'Select', 'date' => 'Date (dd.mm.yyyy)', 'datetime' => 'DateTime (dd.mm.yyyy h:i:s)', 'image' => 'Image',
        'multi_image' => 'Multi Image', 'file' => 'File', 'email' => 'E-mail', 'hidden' => 'Hidden', 'password' => 'Secret',
      ];
      return view('admin.application.field.create', compact('module_name', 'pages', 'rules', 'attributes', 'types'));
    }
  }
  
  public function store(Request $request, $module_name, $related = false)
  {
    $this->dangerStatusMailSend('FieldController-store', $module_name . ' - ' . $related ? 'ilişkili alan' : 'ilişkisiz alan');
    
    if ($related) {
      $relationship = $request['relationship'];
      $partner = $request['partner'];
      // bu model iskelet
      $eleman = [
        'type' => $request['type'],
        'title' => $request['title'],
        'rules' => $request['rules'] ?? [],
        'list' => in_array('list', $request['pages'] ?? []),
        'detail' => in_array('detail', $request['pages'] ?? []),
        'create' => in_array('create', $request['pages'] ?? []),
        'update' => in_array('update', $request['pages'] ?? []),
        'relationship' => [
          'model' => $request['model'],
          'type' => $relationship,
          'keys' => [],
          'pluck' => [
            'display' => $request['display'],
            'value' => 'id',
          ],
          'fields' => $request['fields'],
        ],
      ];
      
      // karşı model iskelet
      $partner_model = new $request['model'];
      $partner_model_name = class_basename($partner_model);
      $partner_eleman = [
        'type' => '',
        'title' => $module_name,
        'rules' => $request['partner_rules'] ?? [],
        'list' => in_array('list', $request['partner_pages'] ?? []),
        'detail' => in_array('detail', $request['partner_pages'] ?? []),
        'create' => in_array('create', $request['partner_pages'] ?? []),
        'update' => in_array('update', $request['partner_pages'] ?? []),
        'relationship' => [
          'model' => "Modules\\$module_name\\Models\\$module_name",
          'type' => '',
          'keys' => [],
          'pluck' => [
            'display' => $request['partner_display'],
            'value' => 'id',
          ],
          'fields' => $request['this_fields'],
        ],
      ];
      
      $partner_key = $partner_model_name;
      
      // teke tek ise:
      if ($relationship === 'hasOne' || ($relationship === 'belongsTo' && $partner === 'hasOne')) {
        if ($relationship == 'hasOne') {
          // bulunduğum model
          $eleman['relationship']['keys']['foreignKey'] = 'id';
          $eleman['relationship']['keys']['otherKey'] = $partner_model_name;
          
          // partner model
          $partner_eleman['type'] = 'select';
          $partner_eleman['relationship']['type'] = 'belongsTo';
          $partner_eleman['relationship']['keys']['foreignKey'] = 'id';
          $partner_eleman['relationship']['keys']['otherKey'] = $partner_model_name;
          $partner_eleman['relationship']['keys']['partner'] = 'hasOne';
        } else {
          // bulunduğum model
          $eleman['relationship']['keys']['foreignKey'] = 'id';
          $eleman['relationship']['keys']['otherKey'] = $module_name;
          $eleman['relationship']['keys']['partner'] = $partner;
          
          // partner model
          $partner_eleman['type'] = 'select';
          $partner_eleman['relationship']['type'] = 'hasOne';
          $partner_eleman['relationship']['keys']['foreignKey'] = 'id';
          $partner_eleman['relationship']['keys']['otherKey'] = $module_name;
        }
        $partner_key = $partner_model_name;
      }
      
      // teke çok ise:
      if ($relationship === 'hasMany' || ($relationship === 'belongsTo' && $partner === 'hasMany')) {
        // karşı tabloda bulunacak key.
        if ($relationship == 'hasMany') {
          // bulunduğum model
          $eleman['relationship']['keys']['foreignKey'] = $partner_model_name;
          $eleman['relationship']['keys']['otherKey'] = 'id';
          
          // partner model
          $partner_eleman['type'] = 'select';
          $partner_eleman['relationship']['type'] = 'belongsTo';
          $partner_eleman['relationship']['keys']['foreignKey'] = $partner_model_name;
          $partner_eleman['relationship']['keys']['otherKey'] = 'id';
          $partner_eleman['relationship']['keys']['partner'] = 'hasMany';
          $partner_eleman['multiple'] = true;
          $partner_eleman['relationship']['perPage'] = $request['perPage'] ?? 7;
        } else {
          // bulunduğum model
          $eleman['relationship']['keys']['foreignKey'] = $module_name;
          $eleman['relationship']['keys']['otherKey'] = 'id';
          $eleman['relationship']['keys']['partner'] = 'hasMany';
          $eleman['multiple'] = true;
          $eleman['relationship']['perPage'] = $request['perPage'] ?? 7;
          
          // partner model
          $partner_eleman['type'] = 'select';
          $partner_eleman['relationship']['type'] = 'hasMany';
          $partner_eleman['relationship']['keys']['foreignKey'] = $module_name;
          $partner_eleman['relationship']['keys']['otherKey'] = 'id';
        }
      }
      
      // çoka çok ise:
      if ($relationship === 'belongsToMany') {
        // bulunduğum model
        $eleman['relationship']['keys']['foreignKey'] = $partner_model_name;
        $eleman['relationship']['keys']['otherKey'] = $module_name;
        $eleman['multiple'] = true;
        $eleman['relationship']['perPage'] = $request['perPage'] ?? 7;
        $eleman['relationship']['keys']['table'] = $module_name . $partner_model_name;
        
        // partner model
        $partner_eleman['type'] = $request['type'];
        $partner_eleman['relationship']['type'] = 'belongsToMany';
        $partner_eleman['relationship']['keys']['foreignKey'] = $module_name;
        $partner_eleman['relationship']['keys']['otherKey'] = $partner_model_name;
        $partner_eleman['multiple'] = true;
        $partner_eleman['relationship']['perPage'] = $request['perPage'] ?? 7;
        $partner_eleman['relationship']['keys']['table'] = $module_name . $partner_model_name;
      }
      
      $partner_path = storage_path("app\modules\sources\\$partner_model_name.json");
      $partner_source = json_decode(file_get_contents($partner_path), true);
      
      $partner_fields = $partner_source['fields'];
      $partner_count = count($partner_fields);
      $partner_count = $partner_count - 2;
      // dizi elemanlarının arasına eleman sokuşturmak.
      $partner_source['fields'] = array_slice($partner_fields, 0, $partner_count, true) + [Str::studly($module_name) => $partner_eleman] +
        array_slice($partner_fields, $partner_count, count($partner_fields) - 1, true);
      file_put_contents($partner_path, json_encode($partner_source));
    } else {
      $eleman = $this->ordinaryFieldFilling($request);
    }
    $path = storage_path("app\modules\sources\\$module_name.json");
    $source = json_decode(file_get_contents($path), true);
    $fields = $source['fields'];
    $count = count($fields);
    $count = ($request['order'] > $count - 2) ? $count - 2 : $request['order'];
    
    // dizi elemanlarının arasına eleman sokuşturmak.
    $source['fields'] = array_slice($fields, 0, $count, true) + [$request['name'] ?? Str::studly($partner_key) => $eleman] +
      array_slice($fields, $count, count($fields) - 1, true);
    file_put_contents($path, json_encode($source));
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
    $pages = $this->getPages();
    $path = storage_path("app\modules\sources\\$module_name.json");
    $cells = json_decode(file_get_contents($path), true)['fields'][$key];
    $rules = $this->getRules();
    $attributes = $this->getAttributes();
    
    return view('admin.application.field.edit', compact('cells', 'pages', 'module_name', 'key', 'rules', 'attributes'));
  }
  
  public function update(Request $request, $module_name, $key)
  {
    $path = storage_path("app\modules\sources\\$module_name.json");
    $source = json_decode(file_get_contents($path), true);
    $eleman = $source['fields'][$key];
    $eleman['title'] = $request['title'];
    $eleman['rules'] = $request['rules'];
    $eleman['attributes'] = $request['attributes'];
    $eleman['list'] = in_array('list', $request['pages'] ?? []);
    $eleman['detail'] = in_array('detail', $request['pages'] ?? []);
    $eleman['create'] = in_array('create', $request['pages'] ?? []);
    $eleman['update'] = in_array('update', $request['pages'] ?? []);
    $source['fields'][$key] = $eleman;
    file_put_contents($path, json_encode($source));
    session()->flash('info', "\"$key\" alanı başarıyla düzenlendi.");
    return redirect()->back();
  }
  
  public function destroy($module_name, $key)
  {
    $forbiddenFields = ['id', 'created_at', 'updated_at'];
    if (in_array($key, $forbiddenFields)) return redirect()->route('modules.show', $module_name);
    
    $path = storage_path("app\modules\sources\\$module_name.json");
    $source = json_decode(file_get_contents($path), true);
    
    // Silinen modülün diğer json source lardaki ilişkili alanlarını silmektedir.
    foreach ($source['fields'] as $field_key => $field_val) {
      if (@$field_val['relationship']) {
        $json_path = storage_path("app/modules/sources/$field_key.json");;
        if (($json = json_decode(file_get_contents($json_path), true))) {
          // eğer ortak bir tablo varsa (belongsToMany ise) 
          if (($drop_table_name = @$field_val['relationship']['keys']['table'])) {
            Schema::dropIfExists($drop_table_name);
          }
          unset($json['fields'][$module_name]);
          
          file_put_contents($json_path, json_encode($json));
        }
      }
    }
    
    // alanın diğer source lardaki ilişkilerini sildikten sonra alanın kendini siliyorum.
    $fields = $source['fields'];
    unset($fields[$key]);
    $source['fields'] = $fields;
    file_put_contents($path, json_encode($source));
    
    session()->flash('danger', "$module_name modülündeki \"$key\" alanı silindi.");
    return redirect()->route('modules.show', $module_name);
  }
  
  public function getFields(Request $request)
  {
    $model = new $request->model;
    return $model->getSettings('fields');
  }
  
  private function ordinaryFieldFilling(Request $request) : array
  {
    $eleman = [
      'type' => $request['type'],
      'title' => $request['title'],
      'unit' => $request['unit'],
      'rules' => $request['rules'] ?? [],
      'attributes' => $request['attributes'] ?? [],
      'list' => in_array('list', $request['pages'] ?? []),
      'detail' => in_array('detail', $request['pages'] ?? []),
      'create' => in_array('create', $request['pages'] ?? []),
      'update' => in_array('update', $request['pages'] ?? []),
    ];
    switch ($eleman['type']) {
      case 'image':
        $eleman['value'] = $request['values'];
        break;
      case 'multi_image':
        $eleman['count'] = $request['values'] ?? 1000000000000;
        break;
      case 'radio':
      case 'select':
        foreach (explode("|", $request['values']) as $item) $dizi[$item] = $item;
        $eleman['items'] = $dizi;
        break;
      case 'checkbox':
        $eleman['label'] = $request['values'];
        break;
      case 'decimal':
        $eleman['type'] = 'number';
        $eleman['decimal'] = true;
        break;
    }
    return $eleman;
  }
  
  private function getRules() : array
  {
    $rules = ['required', 'accepted', 'alpha', 'alpha_num', 'array', 'boolean', 'image', 'email', 'nullable', 'file', 'string',
      'integer', 'numeric', 'date', 'url', 'phone:TR,AUTO'];
    return $rules;
  }
  
  private function getAttributes() : array
  {
    $attributes = ['required' => 'required', 'autofocus' => 'autofocus', 'disabled' => 'disabled'];
    return $attributes;
  }
  
  private function getPages() : array
  {
    $pages = ['list', 'detail', 'create', 'update'];
    return $pages;
  }
}
