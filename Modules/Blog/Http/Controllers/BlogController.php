<?php

namespace Modules\Blog\Http\Controllers;

use App\Traits\ControllerTraits\HelperMethods;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Blog\Models\Blog;
use Modules\Blog\Http\Requests\BlogCreateRequest;
use Modules\Blog\Http\Requests\BlogEditRequest;

class BlogController extends Controller
{
  use HelperMethods;
  private $model = null;
  private $jsonSettings = null;
  
  public function __construct()
  {
    $this->model = new Blog();
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
    return view('blog::index', compact('settings'));
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
    return view('blog::create', compact('settings'));
  }
  
  public function store(BlogCreateRequest $request)
  {
    $fields = $this->jsonSettings['fields'];
    $operation_type = 'create';
    foreach ($fields as $key => $field) {
      if ( !$field[$operation_type]) continue;
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
        default:
          break;
      }
    }
    
    $this->model->saveOrFail();
    
    $this->many_to_many_sync($request, $fields, $operation_type);
    session()->flash('success', 'Kayıt başarıyla eklendi.');
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
    return view('blog::show', compact('settings'));
  }
  
  public function edit($id)
  {
    $this->model = $this->model->findOrFail($id);
    $operation_type = 'edit';
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
    return view('blog::edit', compact('settings'));
  }
  
  public function update(BlogEditRequest $request, $id)
  {
    $this->model = $this->model->findOrFail($id);
    $fields = $this->jsonSettings['fields'];
    $operation_type = 'edit';
    foreach ($fields as $key => $field) {
      if ( !$field[$operation_type]) continue;
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
        default:
          break;
      }
    }
    
    $this->model->saveOrFail();
    
    $this->many_to_many_sync($request, $fields, $operation_type);
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
