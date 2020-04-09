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
    $rules = ['required', 'accepted', 'alpha', 'alpha_num', 'array', 'boolean', 'image', 'email', 'nullable', 'file', 'string', 'numeric', 'date',
      'url', 'phone:TR,AUTO'];
    $attributes = ['required' => 'required', 'autofocus' => 'autofocus', 'disabled' => 'disabled'];
    $pages = ['list', 'detail', 'create', 'update'];
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
      $types = ['text' => 'Text', 'number' => 'Numeric', 'textarea' => 'Textarea', 'radio' => 'Radio Button', 'checkbox' => 'CheckBox (true, false)',
        'select' => 'Select', 'date' => 'Date (dd.mm.yyyy)', 'datetime' => 'DateTime (dd.mm.yyyy h:i:s)', 'image' => 'Image',
        'multi_image' => 'Multi Image', 'file' => 'File', 'email' => 'E-mail', 'hidden' => 'Hidden', 'password' => 'Secret',
      ];
      return view('admin.application.field.create', compact('module_name', 'pages', 'rules', 'attributes', 'types'));
    }
  }
  
  public function store(Request $request, $module_name, $related = false)
  {
    $key = $request['name'];
  
    if ($related) {
      $relationship = $request['relationship'];
      $partner = $request['partner'];
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
          'keys' => [
            'foreignKey' => $request['foreignKey'],
            'otherKey' => $request['otherKey'],
          ],
          'pluck' => [
            'display' => $request['display'],
            'value' => $request['value'],
          ],
          'fields' => $request['fields'],
        ],
      ];
      
      if ($relationship === 'belongsToMany') {
        $eleman['relationship']['keys']['table'] = $request['table'];
      }
      
      $isBelongsToOrHasMany = ($relationship === 'belongsTo' && $partner === 'hasMany');
      if ($partner === 'hasMany' || $isBelongsToOrHasMany) {
        $key = $eleman['relationship']['keys']['foreignKey'];
        $eleman['relationship']['keys']['partner'] = $partner;
      }
      if ($partner === 'hasOne') {
        $key = $eleman['relationship']['keys']['otherKey'];
        $eleman['relationship']['keys']['partner'] = $partner;
      }
      
      if ($relationship === 'belongsToMany' || $isBelongsToOrHasMany) {
        $eleman['multiple'] = true;
        $eleman['relationship']['perPage'] = $request['perPage'] ?? 7;
      }
      
      // eğer karşı tabloda o anahtarın olmasını mecbur kılmak isteniyorsa.
      if ($relationship === 'hasOne' || $relationship === 'hasMany' || $isBelongsToOrHasMany) {
        // karşı tabloya o key eklenmeli. $request['foreignKey'] den gelecek değer ile.
        $partner_model = new $request['model'];
        $partner_model_name = class_basename($partner_model);
        $partner_path = storage_path("app\modules\sources\\$partner_model_name.json");
        $partner_source = json_decode(file_get_contents($partner_path), true);
        $partner_eleman = [
          'type' => 'select',
          'title' => $module_name,
          'rules' =>  $request['partner_rules'] ?? [],
          'list' => in_array('list', $request['partner_pages'] ?? []),
          'detail' => in_array('detail', $request['partner_pages'] ?? []),
          'create' => in_array('create', $request['partner_pages'] ?? []),
          'update' => in_array('update', $request['partner_pages'] ?? []),
          'relationship' => [
            'model' => "Modules\\$module_name\\Models\\$module_name",
            'type' => 'belongsTo',
            'keys' => [
              // hasOne varsayılan değerleri
              'foreignKey' => $request['otherKey'],
              'otherKey' => $request['foreignKey'],
              'partner' => 'hasOne',
            ],
            'pluck' => [
              'display' => $request['partner_display'],
              'value' => $request['partner_value'],
            ],
            'fields' => $request['this_fields'],
          ],
        ];
        if ($relationship === 'hasMany' || $relationship === 'belongsTo') {
          $partner_eleman['relationship']['keys']['foreignKey'] = $request['foreignKey'];
          $partner_eleman['relationship']['keys']['otherKey'] = $request['otherKey'];
          $partner_eleman['relationship']['keys']['partner'] = 'hasMany';
        }
        
        $partner_fields = $partner_source['fields'];
        $partner_count = count($partner_fields);
        $partner_count = ($request['order'] > $partner_count - 2) ? $partner_count - 2 : $request['order'];
        
        // dizi elemanlarının arasına eleman sokuşturmak.
        $partner_source['fields'] = array_slice($partner_fields, 0, $partner_count, true) + [$key => $partner_eleman] +
          array_slice($partner_fields, $partner_count, count($partner_fields) - 1, true);
        file_put_contents($partner_path, json_encode($partner_source));
      }
    } else {
      $eleman = $this->ordinaryFieldFilling($request);
    }
    $path = storage_path("app\modules\sources\\$module_name.json");
    $source = json_decode(file_get_contents($path), true);
    $fields = $source['fields'];
    $count = count($fields);
    $count = ($request['order'] > $count - 2) ? $count - 2 : $request['order'];
    
    // dizi elemanlarının arasına eleman sokuşturmak.
    $source['fields'] = array_slice($fields, 0, $count, true) + [$key => $eleman] +
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
    
    session()->flash('danger', "$module_name modülündeki \"$key\" alanı silindi.");
    return redirect()->route('modules.show', $module_name);
  }
  
  public function getFields(Request $request)
  {
    $model = new $request->model;
    $fields = $model->getSettings('fields');
    
    return $fields;
    //$path = storage_path("app\modules\sources\\$module_name.json");
    //$source = json_decode(file_get_contents($path), true);
    //return  $source['fields'];
  }
  
  /**
   * @param Request $request
   *
   * @return array
   */
  private function ordinaryFieldFilling(Request $request) : array
  {
    $eleman = [
      'type' => $request['type'],
      'title' => $request['title'],
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
        $eleman['count'] = $request['values'] ?? 100000000000000000;
        $eleman['multiple'] = true;
        break;
      case 'radio':
      case 'select':
        foreach (explode("|", $request['values']) as $item) $dizi[$item] = $item;
        $eleman['items'] = $dizi;
        break;
      case 'checkbox':
        $eleman['label'] = $request['values'];
        break;
    }
    return $eleman;
  }
}
