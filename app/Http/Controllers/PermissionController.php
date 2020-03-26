<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
  private $model = null;
  
  public function __construct()
  {
    $this->model = new Permission();
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
    
    return view('admin.permission.index', compact('data'));
  }
  
  public function create()
  {
    $model = $this->model;
    $roles = Role::pluck('name', 'id');
    
    return view('admin.permission.create', compact('model', 'roles'));
  }
  
  public function store(CreatePermissionRequest $request)
  {
    $this->model->name = $request->name;
    $this->model->saveOrFail();
    $this->model->syncRoles($request->roles);
    foreach ($request->roles as $role) {
      foreach (User::role($role)->get() as $user)
        $user->syncPermissions($user->getPermissionsViaRoles());
    }
    
    session()->flash('success', 'İzin başarıyla eklendi.');
    return redirect()->back();
  }
  
  public function show($id)
  {
    $model = $this->model->findOrFail($id);
    $users = User::permission($model->name)->paginate(7);
    $roles = $model->roles()->paginate(7);
    return view('admin.permission.show', compact('model', 'users', 'roles'));
  }
  
  public function edit($id)
  {
    $model = $this->model->findOrFail($id);
    $roles = Role::pluck('name', 'id');
    return view('admin.permission.edit', compact('model', 'roles'));
  }
  
  public function update(UpdatePermissionRequest $request, $id)
  {
    $this->model = $this->model->findOrFail($id);
    $this->model->name = $request->name;
    $this->model->saveOrFail();
    $this->model->syncRoles($request->roles);
    foreach (Role::all() as $role) {
      foreach (User::role($role)->get() as $user)
        $user->syncPermissions($user->getPermissionsViaRoles());
    }
    
    session()->flash('info', 'İzin başarıyla güncellendi.');
    return redirect()->back();
  }
  
  public function destroy(Request $request)
  {
    if (($id = $request->id) && ($back = $request->back)) {
      $this->model->destroy($id);
      session()->flash('danger', 'İzin silindi.');
      if (($indexURL = route('permission.index')) !== $back)
        $back = $indexURL;
      return redirect($back);
    }
    $models = $this->model->whereIn('id', $request->checked);
    session()->flash('danger', 'Seçili izinler silindi.');
    return $models->delete();
  }
}
