<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
  private $model = null;
  
  public function __construct()
  {
    $this->model = new Role();
  }
  
  public function index()
  {
    $data = null;
    if ($search = \request()->input('ara')) {
      $conditions = ['name'];
      $data = $this->model->where(function ($query) use ($conditions, $search) {
        foreach ($conditions as $column)
          $query->orWhere($column, 'like', '%' . $search . '%');
      })->orderByDESC('id')->paginate(7);
    } else
      $data = $this->model->orderByDESC('id')->paginate(7);
    
    return view('admin.role.index', compact('data'));
  }
  
  public function create()
  {
    $model = $this->model;
    $permissions = Permission::pluck('name', 'id');
    
    return view('admin.role.create', compact('model', 'permissions'));
  }
  
  public function store(CreateRoleRequest $request)
  {
    $this->model->name = $request->name;
    $this->model->saveOrFail();
    $this->model->syncPermissions($request->permissions);

    session()->flash('success', 'Rol başarıyla eklendi.');
    return redirect()->back();
  }
  
  public function show($id)
  {
    $model = $this->model->findOrFail($id);
    $users = User::role($model->name)->paginate(7);
    $permissions = $model->permissions()->paginate(7);
    return view('admin.role.show', compact('model', 'users', 'permissions'));
  }
  
  public function edit($id)
  {
    $model = $this->model->findOrFail($id);
    $permissions = Permission::pluck('name', 'id');
    
    return view('admin.role.edit', compact('model', 'permissions'));
  }
  
  public function update(UpdateRoleRequest $request, $id)
  {
    $this->model = $this->model->findOrFail($id);
    $this->model->name = $request->name;
    $this->model->saveOrFail();
    $this->model->syncPermissions($request->permissions);
    foreach (Permission::all() as $permission) {
      foreach (User::permission($permission)->get() as $user)
        $user->syncPermissions($user->getPermissionsViaRoles());
    }
    
    session()->flash('info', 'Rol başarıyla güncellendi.');
    return redirect()->back();
  }
  
  public function destroy(Request $request)
  {
    if (($id = $request->id) && ($back = $request->back)) {
      $this->model->destroy($id);
      session()->flash('danger', 'Rol silindi.');
      if (($indexURL = route('role.index')) !== $back)
        $back = $indexURL;
      return redirect($back);
    }
    $models = $this->model->whereIn('id', $request->checked);
    session()->flash('danger', 'Seçili roller silindi.');
    return $models->delete();
  }
}
