<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Traits\ControllerTraits\HelperMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
  use HelperMethods;
  
  private $model;
  private $genders = ['Erkek' => 'Erkek', 'Kadın' => 'Kadın'];
  
  public function __construct()
  {
    $this->model = new User();
  }
  
  public function index()
  {
    $data = null;
    if ($search = trim(\request()->input('ara'))) {
      $conditions = ['id', 'name', 'surname', 'email', 'gender'];
      $data = $this->model->where('id', '!=', config('my-config.super_admin_id'))
        ->where(function ($query) use ($conditions, $search) {
        foreach ($conditions as $column)
          $query->orWhere($column, 'like', '%' . $search . '%');
      })->orderByDESC('id')->paginate(7);
    } else {
      $data = $this->model->where('id', '!=', config('my-config.super_admin_id'))->orderByDESC('id')->paginate(7);
    }
    return view('admin.user.index', compact('data'));
  }
  
  public function create()
  {
    $model = $this->model;
    $roles = $this->getRoles();
    $genders = $this->genders;
    
    return view('admin.user.create', compact('model', 'roles', 'genders'));
  }
  
  public function store(CreateUserRequest $request)
  {
    $this->saveModelFilling($request);
    $this->model->assignRole($request->roles);
    $this->model->syncPermissions($this->model->getPermissionsViaRoles());
    
    session()->flash('success', 'Kayıt başarıyla eklendi.');
    return redirect()->back();
  }
  
  public function show($id)
  {
    $model = $this->model->findOrFail($id);
    /* getPermissionsViaRoles kullanılırsa sadece rol aracılığı ile bağlatılı olduğu izinler gelir.
      Dezavantaj olarak bir kullanıcıya birden fazla rol verildiğinde,
      roller aynı izinleri bulunduruyorsa fazla sayıda getiriyor aynı izin tiplerini. */
    /* getAllPermissions kullanınıcın bağlantılı olduğu izinler tüm gelir. */
    $roles = $model->getRoleNames();
    $permissions = $model->getAllPermissions();
    $fields = $model->getSettings('fields');
    
    return view('admin.user.show', compact('model', 'roles', 'permissions', 'fields'));
  }
  
  public function edit($id)
  {
    $model = User::findOrFail($id);
    $roles = $this->getRoles();
    $genders = $this->genders;
    
    return view('admin.user.edit', compact('model', 'roles', 'genders'));
  }
  
  public function update(UpdateUserRequest $request, $id)
  {
    $this->model = $this->model->findOrFail($id);
    $this->saveModelFilling($request);
    $this->model->syncRoles($request->roles);
    $this->model->syncPermissions($this->model->getPermissionsViaRoles());
    
    session()->flash('info', 'Kullanıcı başarıyla güncellendi.');
    return redirect()->back();
  }
  
  public function destroy(Request $request)
  {
    if (($id = $request->id) && ($back = $request->back)) {
      User::destroy($id);
      session()->flash('danger', 'Kullanıcı silindi.');
      if (($indexURL = route('user.index')) !== $back)
        $back = $indexURL;
      return redirect($back);
    }
    foreach ($request->checked as $id) {
      $this->model->destroy($id);
    }
    session()->flash('danger', 'Seçili kullanıcılar silindi.');
    return 1;
  }
  
  // store ve update fonksiyonları için ortak model doldurma.
  private function saveModelFilling(Request $request) : void
  {
    $this->model->name = $request->name;
    $this->model->surname = $request->surname;
    $this->model->email = $request->email;
    $this->model->bio = $request->bio;
    $this->model->phone = $request->phone;
    $this->model->gender = $request->gender;
    $this->model->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
    $this->model->confirm = $request->confirm ?? 1;
    if ($request->password)
      $this->model->password = Hash::make($request->password);
    $this->insertToSingleMedia($request, 'profile');
    $this->model->saveOrFail();
  }
  
  // super-admin rolünü filtreliyor ve formlarda görülmesini engelliyor.
  private function getRoles()
  {
    $roles = Role::pluck('name', 'id');
    if (($key = in_array('super-admin', $roles->toArray())) !== false)
      unset($roles[$key]);
    return $roles;
  }
}
