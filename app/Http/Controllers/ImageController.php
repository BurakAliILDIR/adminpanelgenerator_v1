<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;

class ImageController extends Controller
{
  public function imageUpload(Request $request, $id, $collection, $path)
  {
    $path = str_replace('-', '\\', $path);
    
    (new $path)->findOrFail($id)
      ->addMedia($request->file)
      ->sanitizingFileName(function ($fileName) {
        return str_replace(['#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>',
          '%', '$', '£', 'ß', 'æ', '{', '}', '[', ']', '?', '=', '*', '+', '½', ',',
          '~', 'ğ', 'İ', 'ı', '-', 'ç', 'ş', 'ü', 'ö', '_'],
          '', Str::kebab($fileName));
      })
      ->preservingOriginal()
      ->toMediaCollection($collection);
  }
  
  public function deleteImage(Request $request)
  {
    $toDeleteIds = $request->mediaTodelete;
    if (count($toDeleteIds)) {
      Media::whereIn('id', $toDeleteIds)->delete();
    }
    session()->flash('danger', 'Seçili resimler silindi.');
    return redirect()->back();
  }
}
