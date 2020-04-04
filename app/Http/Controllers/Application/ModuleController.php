<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;

class ModuleController extends Controller
{
  public function index()
  {
    $data = Module::all();
    return view('admin.application.module.index', compact('data'));
  }
  
  public function create()
  {
    return view('admin.application.module.create');
  }
  
  public function store(Request $request)
  {
    Artisan::call("module:create $request->name");
    
    session()->flash('success', 'Modül başarıyla eklendi.');
    return redirect()->route('modules.index');
  }
  
  public function show($id)
  {
    $model = Module::findOrFail($id);
    
    return view('admin.application.module.show', compact('model'));
  }
  
  public function edit($id)
  {
    //
  }
  
  public function update(Request $request, $id)
  {
    //
  }
  
  public function destroy($id)
  {
    // TODO : Modülün json dosyasını oluşturmak için bir yol bulunacak. 
    Artisan::call("module:remove $id");
    session()->flash('danger', "$id modülü silindi.");
    return redirect()->back();
  }
}
