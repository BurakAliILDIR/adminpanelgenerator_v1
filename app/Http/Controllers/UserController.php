<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
  private $model = null;
  
  public function __construct()
  {
    $this->model = new User();
  }
  
  public function index()
  {
    $data = null;
    if ($search = \request()->input('ara')) {
      $conditions = ['name', 'surname', 'email', 'gender'];
      $data = $this->model->where(function ($query) use ($conditions, $search) {
        foreach ($conditions as $column)
          $query->orWhere($column, 'like', '%' . $search . '%');
      })->orderByDESC('id')->paginate(7);
    } else
      $data = $this->model->orderByDESC('id')->paginate(7);
    
    return view('admin.user.index', compact('data'));
  }
  
  public function create()
  {
    $model = $this->model;
    return view('admin.user.create', compact('model'));
  }
  
  public function store(CreateUserRequest $request)
  {
    $this->model->name = $request->name;
    $this->model->surname = $request->surname;
    $this->model->email = $request->email;
    $this->model->password = Hash::make($request->password);
    $this->model->bio = $request->bio;
    $this->model->phone = $request->phone;
    $this->model->gender = $request->gender;
    $this->model->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
    $this->model->confirm = $request->confirm ?? 0;
    $this->insertToSingleMedia($request, 'profile');
    $this->model->saveOrFail();
    
    session()->flash('success', 'Kayıt başarıyla eklendi.');
    return redirect()->back();
  }
  
  public function show($id)
  {
    $model = $this->model->findOrFail($id);
    $roles = $model->getRoleNames();
    $permissions = $model->getAllPermissions();
    $fields = $model->getSettings('fields');
    return view('admin.user.show', compact('model', 'roles', 'permissions', 'fields'));
  }
  
  public function edit($id)
  {
    $model = User::findOrFail($id);
    return view('admin.user.edit', compact('model'));
  }
  
  public function update(UpdateUserRequest $request, $id)
  {
    $this->model = $this->model->findOrFail($id);
    $this->model->name = $request->name;
    $this->model->surname = $request->surname;
    $this->model->bio = $request->bio;
    $this->model->phone = $request->phone;
    $this->model->gender = $request->gender;
    $this->model->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
    $this->model->confirm = $request->confirm ?? 0;
    $this->insertToSingleMedia($request, 'profile');
    $this->model->saveOrFail();
    
    session()->flash('info', 'Kayıt başarıyla güncellendi.');
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
    $models = User::whereIn('id', $request->checked);
    session()->flash('danger', 'Seçili kayıtlar silindi.');
    return $models->delete();
  }
  
  private function insertToSingleMedia(Request $request, $name) : void
  {
    if ($request->hasFile($name))
      $this->model
        ->addMedia(\request($name))
        ->sanitizingFileName(function ($fileName) {
          return str_replace(['#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>',
            '%', '$', '£', 'ß', 'æ', '{', '}', '[', ']', '?', '=', '*', '+', '½', ',',
            '~', 'ğ', 'İ', 'ı', '-', 'ç', 'ş', 'ü', 'ö', '_'],
            '', Str::kebab($fileName));
        })->preservingOriginal()
        ->toMediaCollection($name);
  }
}
