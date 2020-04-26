<?php

namespace App\Http\Controllers\DefaultControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Traits\ControllerTraits\HelperMethods;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;

class ProfileController extends Controller
{
  use HelperMethods;

  public function index()
  {
    $model = Auth::user();
    $fields = $model->getSettings('fields');
    $roles = $model->getRoleNames();
    
    return view('admin.profile.index', compact('model', 'fields', 'roles'));
  }
  
  public function edit()
  {
    $model = Auth::user();
    return view('admin.profile.edit', compact('model'));
  }
  
  public function update(UpdateProfileRequest $request)
  {
    $model = Auth::user();
    $model->name = $request->name;
    $model->surname = $request->surname;
    $model->bio = $request->bio;
    $model->phone = $request->phone;
    $model->gender = $request->gender;
    $model->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
    $this->insertToSingleMedia($request, 'profile', $model);
    $model->saveOrFail();
    
    session()->flash('info', 'Profil başarıyla güncellendi.');
    return redirect()->back();
  }
  
  public function imageUpload(Request $request, $collection)
  {
    Auth::user()->addMedia($request->file)
      ->sanitizingFileName(function ($fileName) {
        return str_replace(['#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>',
          '%', '$', '£', 'ß', 'æ', '{', '}', '[', ']', '?', '=', '*', '+', '½', ',',
          '~', 'ğ', 'İ', 'ı', '-', 'ç', 'ş', 'ü', 'ö', '_'],
          '', Str::kebab($fileName));
      })
      ->preservingOriginal()
      ->toMediaCollection($collection);
  }
  
  public function imageDelete(Request $request)
  {
    if ($toDeleteIds = $request->mediaTodelete) {
      Media::whereIn('id', $toDeleteIds)->where('model_id', Auth::id())->delete();
      session()->flash('danger', 'Seçili resimler silindi.');
    }
    return redirect()->back();
  }
}
