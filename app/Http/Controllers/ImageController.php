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
        $model = new $path;
        $model = $model->findOrFail($id);

        $model
            ->addMedia($request->file)
            ->sanitizingFileName(function ($fileName) {
                return str_replace(['#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>',
                    '%', '$', '£', 'ß', 'æ', '{', '}', '[', ']', '?', '=', '*', '+', '½', ',',
                    '~', 'ğ', 'İ', 'ı', '-', 'ç', 'ş', 'ü', 'ö',],
                    '', Str::kebab($fileName));
            })
            ->toMediaCollection($collection);
    }

    public function deleteImage(Request $request)
    {
        $toDeleteIds = $request->mediaTodelete;
        if (count($toDeleteIds)) {
            Media::whereIn('id', $toDeleteIds)->delete();
        }
        return redirect()->back();
    }
}
