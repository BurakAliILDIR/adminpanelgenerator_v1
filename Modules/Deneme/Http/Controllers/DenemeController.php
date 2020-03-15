<?php

namespace Modules\Deneme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Deneme\Entities\Deneme;
use Modules\Deneme\Entities\Post;
use Modules\Sales\Entities\SaleInfo;
use Spatie\MediaLibrary\Models\Media;

class DenemeController extends Controller
{
    public function index()
    {
        $model = new Deneme();
        $data = Deneme::orderByDESC('id')->paginate(10);
        $settings = [
            'operation' => 'list',
            'title' => 'Denemeler',
            'fields' => $model->getFields(),
            'model' => $model,
            'data' => $data,
            'route' => [
                'create' => 'deneme.create',
                'show' => 'deneme.show',
                'edit' => 'deneme.edit',
                'delete' => 'deneme.destroy',
            ],
        ];
        return view('deneme::index', compact('settings'));
    }

    public function create()
    {
        $model = new Deneme();

        $settings = [
            'operation' => 'create',
            'title' => 'Deneme Ekle',
            'fields' => $model->getFields(),
            'model' => $model,
            'route' => 'deneme.store',
            'params' => null,
            'submitText' => 'Ekle',
            'submitAttributes' => [],
            'extra' => [
                'oylesine' => SaleInfo::pluck('buy_price', 'count'),
                'kontrol' => Post::pluck('name', 'id'),
            ],
        ];
        return view('deneme::create', compact('settings'));
    }

    public function store(Request $request)
    {
        return "EKLENDİ";
    }

    public function show($id)
    {
        $model = Deneme::findOrFail($id);


        $settings = [
            'operation' => 'detail',
            'title' => 'Deneme Detay',
            'fields' => $model->getFields(),
            'model' => $model,
            'route' => [
                'create' => 'deneme.create',
                'show' => url()->previous(),
                'edit' => 'deneme.edit',
                'delete' => 'deneme.destroy',
                'imageUpload' => 'deneme.imageUpload',
            ],
        ];
        return view('deneme::show', compact('settings'));
    }

    public function edit($id)
    {
        $model = Deneme::findOrFail($id);
        $settings = [
            'operation' => 'edit',
            'title' => 'Deneme Düzenle',
            'fields' => $model->getFields(),
            'model' => $model,
            'route' => 'deneme.update',
            'params' => $model->id,
            'submitText' => 'Kaydet',
            'submitAttributes' => [],
            'extra' => [
                'oylesine' => SaleInfo::pluck('buy_price', 'count'),
                'kontrol' => Post::pluck('name', 'id'),
            ],
        ];
        return view('deneme::edit', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        return "GÜNCELLENDİ";
    }

    public function destroy($id)
    {
        return 'SİLİNDİ';
    }

    // TODO 1: base controller'larda ImageController adında yeni bir controller açılacak.
    // TODO 2: create ve detete için route tanımlamaları yapılacak. Hatta action() bile kullanılabilir.
    // TODO 3: aşağıdaki imageUpload yani create kodu ImageController'a taşınacak.
    // TODO 4: delete kodu yazılacak.
    // TODO 5: delete işlemi view alanında gerçekleştirilecek.
    // TODO 6: image boyutuna göre uygun resim boyutundaki resimi getirme işlemi yapılacak.
    public function imageUpload(Request $request, $id)
    {
        switch ($request->file->getClientOriginalExtension()) {
            case 'jpeg':
            case 'jpg':
            case 'png':
                $model = Deneme::findOrFail($id);
                $model
                    ->addMedia($request->file)
                    ->sanitizingFileName(function ($fileName) {
                        return strtolower(str_replace([
                            '#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>', '%', '$', '£', 'ß', 'æ',
                            '{', '}', '[', ']', '?', '=', '*', '+', '½', ',', '~', 'ğ', 'İ', 'ı', '-'],
                            '', Str::kebab($fileName)));
                    })
                    ->toMediaCollection();
                break;
        }
    }
}
