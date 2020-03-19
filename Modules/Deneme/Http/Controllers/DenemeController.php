<?php

namespace Modules\Deneme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Deneme\Entities\Deneme;
use Modules\Deneme\Entities\Post;
use Modules\Sales\Entities\SaleInfo;


class DenemeController extends Controller
{
    public function index()
    {
        $model = new Deneme();
        $jsonSettings = $model->getSettings();
        $data = null;
        if ($search = \request()->input('ara')) {
            $conditions = $jsonSettings['searchable'];
            $data = Deneme::where(function ($query) use ($conditions, $search) {
                foreach ($conditions as $column)
                    $query->orWhere($column, 'like', '%' . $search . '%');
            })->orderByDESC('id')->paginate(10);
        } else
            $data = Deneme::orderByDESC('id')->paginate(10);

        $settings = [
            'operation' => 'list',
            'title' => 'Denemeler',
            'fields' => $jsonSettings['fields'],
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
            'fields' => $model->getSettings('fields'),
            'model' => $model,
            'params' => null,
            'submitText' => 'Ekle',
            'submitAttributes' => [],
            'route' => [
                'index' => 'deneme.index',
                'action' => 'deneme.store',
            ],
            'extra' => [
                'count_id' => SaleInfo::pluck('buy_price', 'count'),
                'kontrol' => Post::pluck('name', 'id'),
                'diger' => Post::pluck('name', 'id'),
            ],
        ];
        return view('deneme::create', compact('settings'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $model = new Deneme();
        $fields = $model->getSettings('fields');

        foreach ($fields as $field) {
            if ( !$field['create']) continue;
            $name = $field['name'];
            switch ($field['type']) {
                case 'checkbox':
                    $model[$name] = $request[$name] ?? 0;
                    break;
                case 'radio':
                case 'hidden':
                case 'email':
                case 'number':
                case 'select':
                case 'text':
                case 'textarea':
                    $model[$name] = $request[$name];
                    break;
                case 'date':
                    $model[$name] = \Carbon\Carbon::parse($request[$name])->format('Y-m-d');
                    break;
                case 'date_time':
                    $model[$name] = \Carbon\Carbon::parse($request[$name])->format('Y-m-d H:i:s');
                    break;
                case 'file':
                case 'image':
                    if ($request->hasFile($name))
                        $model
                            ->addMedia(\request($name))
                            ->sanitizingFileName(function ($fileName) {
                                return str_replace(['#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>',
                                    '%', '$', '£', 'ß', 'æ', '{', '}', '[', ']', '?', '=', '*', '+', '½', ',',
                                    '~', 'ğ', 'İ', 'ı', '-', 'ç', 'ş', 'ü', 'ö', '_'],
                                    '', Str::kebab($fileName));
                            })
                            ->toMediaCollection($name);
                    break;
                case 'password':
                    $model[$name] = Hash::make($request[$name]);
                    break;
                default:
                    break;
            }
        }

        $model->saveOrFail();

        foreach ($fields as $field) {
            if ( !$field['create']) continue;
            if ($field['type'] === 'multi_checkbox') {
                //dd($request[$field['name']]);
                $model->relation($field['relationship'])->sync($request[$field['name']]);
            }
        }
        return redirect()->back();
    }

    public
    function show($id)
    {
        $model = Deneme::findOrFail($id);
        $settings = [
            'operation' => 'detail',
            'title' => 'Deneme Detay',
            'fields' => $model->getSettings('fields'),
            'model' => $model,
            'route' => [
                'index' => 'deneme.index',
                'create' => 'deneme.create',
                'show' => url()->previous(),
                'edit' => 'deneme.edit',
                'delete' => 'deneme.destroy',
            ],
        ];
        return view('deneme::show', compact('settings'));
    }

    public
    function edit($id)
    {
        $model = Deneme::findOrFail($id);
        $settings = [
            'operation' => 'edit',
            'title' => 'Deneme Düzenle',
            'fields' => $model->getSettings('fields'),
            'model' => $model,
            'params' => $model->id,
            'submitText' => 'Kaydet',
            'submitAttributes' => [],
            'route' => [
                'index' => 'deneme.index',
                'action' => 'deneme.update',
            ],
            'extra' => [
                'count_id' => SaleInfo::pluck('buy_price', 'count'),
                'kontrol' => Post::pluck('name', 'id'),
                'diger' => Post::pluck('name', 'id'),
            ],
        ];
        return view('deneme::edit', compact('settings'));
    }

    public
    function update(Request $request, $id)
    {
        return "GÜNCELLENDİ";
    }

    public
    function destroy(Request $request)
    {
        $models = Deneme::whereIn('id', $request->checked);
        return $models->delete();
    }
}
