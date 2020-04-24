<?php

namespace Modules\Blog\Http\Controllers;

use App\Traits\ControllerTraits\HelperMethods;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Blog\Http\Requests\CreateBlogRequest;
use Modules\Blog\Http\Requests\UpdateBlogRequest;
use Modules\Blog\Models\Blog;

class BlogController extends Controller
{
  use HelperMethods;
  
  private $model;
  private $jsonSettings;
  private $redis_path;
  
  public function __construct()
  {
    $this->model = new Blog();
    $this->redis_path = config('cache.prefix') . ':Blog';
    $this->redisJsonSettings();
  }
  
  public function index()
  {
    $operation_type = 'list';
    
    $fields = $this->redisReadFields($operation_type);
    
    $data = null;
    $paginate = $this->jsonSettings['paginate'];
    if ($search = trim(\request()->input('ara'))) {
      $conditions = $this->jsonSettings['searchable'];
      $data = $this->model->where(function ($query) use ($conditions, $search) {
        foreach ($conditions as $column)
          $query->orWhere($column, 'like', '%' . $search . '%');
      })->orderByDESC('id')->paginate($paginate, $fields['dbSelectFields']);
    } else
      $data = $this->model->orderByDESC('id')->paginate($paginate, $fields['dbSelectFields']);
    $settings = [
      'title' => $this->jsonSettings['titles']['index'],
      'fields' => $fields['showFields'],
      'model' => $this->model,
      'data' => $data,
      'route' => $this->jsonSettings['routes'],
    ];
    return view('blog::index', compact('settings'));
  }
  
  public function create()
  {
    $operation_type = 'create';
    
    $fields = $this->redisReadFields($operation_type);
    $settings = [
      'title' => $this->jsonSettings['titles']['create'],
      'fields' => $fields['showFields'],
      'model' => $this->model,
      'params' => null,
      'submitText' => 'Ekle',
      'submitAttributes' => [],
      'route' => $this->jsonSettings['routes'],
      'plucks' => $this->getPluck($operation_type),
    ];
    return view('blog::create', compact('settings'));
  }
  
  public function store(CreateBlogRequest $request)
  {
    $operation_type = 'create';
    
    $fields = $this->redisReadFields($operation_type);
    foreach ($fields['showFields'] as $key => $field) {
      switch ($type = $field['type']) {
        case 'checkbox':
          $this->model[$key] = $request[$key] ?? 0;
          break;
        case 'radio':
        case 'hidden':
        case 'email':
        case 'number':
        case 'select':
        case 'text':
        case 'textarea':
          $this->model[$key] = $request[$key];
          break;
        case 'date':
        case 'datetime':
          $this->model[$key] = \Carbon\Carbon::parse($request[$key])->format($type == 'datetime' ? 'Y-m-d H:i:s' : 'Y-m-d');
          break;
        case 'file':
        case 'image':
          $this->insertToSingleMedia($request, $key);
          break;
        case 'password':
          $this->model[$key] = Hash::make($request[$key]);
          break;
      }
    }
    
    $this->model->saveOrFail();
    
    $this->many_to_many_sync($request, $fields['showFields'], $operation_type);
    session()->flash('success', 'Kayıt başarıyla eklendi.');
    return redirect()->back();
  }
  
  public function show($id)
  {
    $operation_type = 'detail';
    
    $fields = $this->redisReadFields($operation_type);
    $this->model = $this->model->findOrFail($id, $fields['dbSelectFields']);
    $settings = [
      'title' => $this->jsonSettings['titles']['show'],
      'fields' => $fields['showFields'],
      'model' => $this->model,
      'route' => $this->jsonSettings['routes'],
    ];
    return view('blog::show', compact('settings'));
  }
  
  public function edit($id)
  {
    $operation_type = 'update';
    
    $fields = $this->redisReadFields($operation_type);
    $this->model = $this->model->findOrFail($id, array_merge($fields['dbSelectFields'], ['id']));
    $operation_type = 'update';
    $settings = [
      'title' => $this->jsonSettings['titles']['edit'],
      'fields' => $fields['showFields'],
      'model' => $this->model,
      'params' => $this->model->id,
      'submitText' => 'Kaydet',
      'submitAttributes' => [],
      'route' => $this->jsonSettings['routes'],
      'plucks' => $this->getPluck($operation_type),
    ];
    return view('blog::edit', compact('settings'));
  }
  
  public function update(UpdateBlogRequest $request, $id)
  {
    $operation_type = 'update';
    
    $fields = $this->redisReadFields($operation_type);
    $this->model = $this->model->findOrFail($id, array_merge($fields['dbSelectFields'], ['id']));
    
    foreach ($fields['showFields'] as $key => $field) {
      switch ($type = $field['type']) {
        case 'checkbox':
          $this->model[$key] = $request[$key] ?? 0;
          break;
        case 'radio':
        case 'hidden':
        case 'email':
        case 'number':
        case 'select':
        case 'text':
        case 'textarea':
          $this->model[$key] = $request[$key];
          break;
        case 'date':
        case 'datetime':
          $this->model[$key] = \Carbon\Carbon::parse($request[$key])->format($type === 'datetime' ? 'Y-m-d H:i:s' : 'Y-m-d');
          break;
        case 'file':
        case 'image':
          $this->insertToSingleMedia($request, $key);
          break;
        case 'password':
          $this->model[$key] = Hash::make($request[$key]);
          break;
      }
    }
    
    $this->model->saveOrFail();
    
    $this->many_to_many_sync($request, $fields['showFields'], $operation_type);
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
    foreach ($request->checked as $id) {
      $this->model->destroy($id);
    }
    session()->flash('danger', 'Seçili kayıtlar silindi.');
    return 1;
  }
}
  
