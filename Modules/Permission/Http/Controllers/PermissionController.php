<?php

namespace Modules\Permission\Http\Controllers;

use App\Traits\ControllerTraits\HelperMethods;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Permission\Models\Permission;
use Modules\Permission\Http\Requests\CreatePermissionRequest;
use Modules\Permission\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
  use HelperMethods;
  private $model = null;
  private $jsonSettings = null;
  
  public function __construct()
  {
    $this->model = new Permission();
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
    return view('permission::index', compact('settings'));
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
    return view('permission::create', compact('settings'));
  }
  
  public function store(CreatePermissionRequest $request)
  {
    $permission = new \Spatie\Permission\Models\Permission();
    
    $fields = $this->jsonSettings['fields'];
    $operation_type = 'create';
    foreach ($fields as $key => $field) {
      if ( !$field[$operation_type]) continue;
      if ($field['type'] === 'text')
        $permission[$key] = $request[$key];
    }
    $permission->saveOrFail();
    $permission->syncRoles($request->roles);
  
    session()->flash('success', 'İzin başarıyla eklendi.');
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
    return view('permission::show', compact('settings'));
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
    return view('permission::edit', compact('settings'));
  }
  
  public function update(UpdatePermissionRequest $request, $id)
  {
    $permission = (new \Spatie\Permission\Models\Permission())->findOrFail($id);
  
    $fields = $this->jsonSettings['fields'];
    $operation_type = 'update';
    foreach ($fields as $key => $field) {
      if ( !$field[$operation_type]) continue;
      if ($field['type'] === 'text')
        $permission[$key] = $request[$key];
    }
    $permission->saveOrFail();
    $permission->syncRoles($request->roles);
    
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
