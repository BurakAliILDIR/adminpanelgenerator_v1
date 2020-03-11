<?php

namespace Modules\Deneme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Deneme\Entities\Deneme;
use Modules\Deneme\Entities\Post;
use Modules\Sales\Entities\SaleInfo;

class DenemeController extends Controller
{
    public function index()
    {
        $model = new Deneme();
        $data = Deneme::orderByDESC('id')->paginate(10);
        $settings = [
            'operation' => 'list',
            'title' => 'Denemeler',
            'fields' => $model->fields,
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
            'fields' => $model->fields,
            'model' => $model,
            'route' => 'deneme.store',
            'params' => null,
            'submitText' => 'Ekle',
            'submitAttributes' => [],
            'extra' => [
                'oylesine' => SaleInfo::pluck('product_id', 'id'),
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
            'fields' => $model->fields,
            'model' => $model,
            'route' => [
                'create' => 'deneme.create',
                'show' => url()->previous(),
                'edit' => 'deneme.edit',
                'delete' => 'deneme.destroy',
            ],
        ];
        return view('deneme::show');
    }

    public function edit($id)
    {
        $model = Deneme::findOrFail($id);
        $settings = [
            'operation' => 'edit',
            'title' => 'Deneme Düzenle',
            'fields' => $model->fields,
            'model' => $model,
            'route' => 'deneme.update',
            'params' => $model->id,
            'submitText' => 'Kaydet',
            'submitAttributes' => [],
            'extra' => [
                'oylesine' => SaleInfo::pluck('product_id', 'id'),
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
}
