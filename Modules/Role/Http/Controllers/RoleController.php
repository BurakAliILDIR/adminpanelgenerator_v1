<?php

namespace Modules\Role\Http\Controllers;

use App\Traits\ControllerTraits\HelperMethods;
use App\Traits\ModelTraits\SourceSettings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Role\Http\Requests\CreateRoleRequest;
use Modules\Role\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
  use HelperMethods;
  private $model = null;
  private $jsonSettings = null;
  
  public function __construct()
  {
    $this->model = new \Modules\Role\Models\Role();
    $this->jsonSettings = $this->model->getSettings();
  }
  
  public function index()
  {
    $data = null;
    $paginate = $this->jsonSettings['paginate'];
    if ($search = \request()->input('ara')) {
      $conditions = $this->jsonSettings['searchable'];
      $data = $this->model->where(function ($query) use ($conditions, $search) {
        foreach ($conditions as $column)
          $query->orWhere($column, 'like', '%' . $search . '%');
      })->orderByDESC('id')->paginate($paginate);
    } else
      $data = $this->model->orderByDESC('id')->paginate($paginate);
    
    $settings = [
      'operation' => 'list',
      'title' => $this->jsonSettings['titles']['index'],
      'fields' => $this->jsonSettings['fields'],
      'model' => $this->model,
      'data' => $data,
      'route' => $this->jsonSettings['routes'],
    ];
    return view('role::index', compact('settings'));
  }
  
  public function create()
  {
    $operation_type = 'create';
    $settings = [
      'operation' => $operation_type,
      'title' => $this->jsonSettings['titles']['create'],
      'fields' => $this->jsonSettings['fields'],
      'model' => $this->model,
      'params' => null,
      'submitText' => 'Ekle',
      'submitAttributes' => [],
      'route' => $this->jsonSettings['routes'],
      'plucks' => $this->getPluck($operation_type),
    ];
    return view('role::create', compact('settings'));
  }
  
  public function store(CreateRoleRequest $request)
  {
    $role = new \Spatie\Permission\Models\Role();
    
    $fields = $this->jsonSettings['fields'];
    $operation_type = 'create';
    foreach ($fields as $key => $field) {
      if ( !$field[$operation_type]) continue;
      if ($field['type'] === 'text')
        $role[$key] = $request[$key];
    }
    $role->saveOrFail();
    $role->syncPermissions($request->permissions);
    
    session()->flash('success', 'Rol başarıyla eklendi.');
    return redirect()->back();
  }
  
  public function show($id)
  {
    $this->model = $this->model->findOrFail($id);
    $settings = [
      'operation' => 'detail',
      'title' => $this->jsonSettings['titles']['show'],
      'fields' => $this->jsonSettings['fields'],
      'model' => $this->model,
      'route' => $this->jsonSettings['routes'],
    ];
    return view('role::show', compact('settings'));
  }
  
  public function edit($id)
  {
    $this->model = $this->model->findOrFail($id);
    $operation_type = 'update';
    $settings = [
      'operation' => $operation_type,
      'title' => $this->jsonSettings['titles']['edit'],
      'fields' => $this->jsonSettings['fields'],
      'model' => $this->model,
      'params' => $this->model->id,
      'submitText' => 'Kaydet',
      'submitAttributes' => [],
      'route' => $this->jsonSettings['routes'],
      'plucks' => $this->getPluck($operation_type),
    ];
    return view('role::edit', compact('settings'));
  }
  
  public function update(UpdateRoleRequest $request, $id)
  {
    $role = (new \Spatie\Permission\Models\Role())->findOrFail($id);
  
    $fields = $this->jsonSettings['fields'];
    $operation_type = 'update';
    foreach ($fields as $key => $field) {
      if ( !$field[$operation_type]) continue;
      if ($field['type'] === 'text')
        $role[$key] = $request[$key];
    }
    $role->saveOrFail();
    $role->syncPermissions($request->permissions);
    
    session()->flash('info', 'Kayıt başarıyla güncellendi.');
    return redirect()->back();
  }
  
  public function destroy(Request $request)
  {
    if (($id = $request->id) && ($back = $request->back)) {
      $this->model->destroy($id);
      session()->flash('danger', 'Kayıt silindi.');
      if (($indexURL = route($this->jsonSettings['routes']['index'])) !== $back)
        $back = $indexURL;
      return redirect($back);
    }
    $models = $this->model->whereIn('id', $request->checked);
    session()->flash('danger', 'Seçili kayıtlar silindi.');
    return $models->delete();
  }
}
