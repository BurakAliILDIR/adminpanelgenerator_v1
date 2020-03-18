<?php

namespace Modules\Deneme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Deneme\Entities\Deneme;
use Modules\Deneme\Entities\Post;
use Modules\Sales\Entities\SaleInfo;

class PostController extends Controller
{
    public function index()
    {
        $model = new Post();
        $data = Post::orderByDESC('id')->paginate(10);
        $settings = [
            'operation' => 'list',
            'title' => 'Postlar',
            'fields' => $model->getSettings('fields'),
            'model' => $model,
            'data' => $data,
            'route' => [
                'create' => 'post.create',
                'show' => 'post.show',
                'edit' => 'post.edit',
                'delete' => 'post.destroy',
            ],
        ];
        return view('deneme::index', compact('settings'));
    }


    public function create()
    {
        $model = new Post();

        $settings = [
            'operation' => 'create',
            'title' => 'Post Ekle',
            'fields' => $model->getSettings('fields'),
            'model' => $model,
            'route' => 'post.store',
            'params' => null,
            'submitText' => 'Ekle',
            'submitAttributes' => [],
            'extra' => [
                'denemeler' => Deneme::pluck('ad', 'id'),
            ],
        ];
        return view('deneme::create', compact('settings'));
    }

    public function store(Request $request)
    {
        dd($request->denemeler);
        return "EKLENDİ";
    }

    public function show($id)
    {
        $model = Post::findOrFail($id);
        $settings = [
            'operation' => 'detail',
            'title' => 'Post Detay',
            'fields' => $model->getSettings('fields'),
            'model' => $model,
            'route' => [
                'create' => 'post.create',
                'show' => url()->previous(),
                'edit' => 'post.edit',
                'delete' => 'post.destroy',
            ],
        ];
        return view('deneme::show', compact('settings'));
    }

    public function edit($id)
    {
        $model = Post::findOrFail($id);
        $settings = [
            'operation' => 'edit',
            'title' => 'Post Düzenle',
            'fields' => $model->getSettings('fields'),
            'model' => $model,
            'route' => 'post.update',
            'params' => $model->id,
            'submitText' => 'Kaydet',
            'submitAttributes' => [],
            'extra' => [
                'denemeler' => Deneme::pluck('ad', 'id'),
            ],
        ];
        return view('deneme::edit', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        dd($request->denemeler);
        return "GÜNCELLENDİ";
    }

    public function destroy($id)
    {
        return 'SİLİNDİ';
    }
}
