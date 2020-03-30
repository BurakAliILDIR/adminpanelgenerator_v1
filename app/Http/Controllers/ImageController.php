<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Permission;

class ImageController extends Controller
{
  public function imageUpload(Request $request, $id, $collection, $path)
  {
    $path = str_replace('-', '\\', $path);
    $model = new $path;
    $permission = class_basename($model) . '.imageUpload';
    if (auth()->check() && auth()->user()->can($permission)) {
      
      $model->findOrFail($id)
        ->addMedia($request->file)
        ->sanitizingFileName(function ($fileName) {
          return str_replace(['#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>',
            '%', '$', '£', 'ß', 'æ', '{', '}', '[', ']', '?', '=', '*', '+', '½', ',',
            '~', 'ğ', 'İ', 'ı', '-', 'ç', 'ş', 'ü', 'ö', '_'],
            '', Str::kebab($fileName));
        })
        ->preservingOriginal()
        ->toMediaCollection($collection);
    } else
      throw UnauthorizedException::forPermissions([$permission]);
  }
  
  public function imageDelete(Request $request, $class_name)
  {
    $permission = $class_name . '.imageDelete';
    if (auth()->check() && auth()->user()->can($permission)) {
      if ($toDeleteIds = $request->mediaTodelete) {
        Media::whereIn('id', $toDeleteIds)->delete();
        session()->flash('danger', 'Seçili resimler silindi.');
      }
    }
    return redirect()->back();
  }
}
