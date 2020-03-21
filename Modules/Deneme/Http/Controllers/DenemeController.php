<?php

namespace Modules\Deneme\Http\Controllers;

use App\Traits\ControllerTraits\HelperMethods;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Deneme\Entities\Deneme;
use Modules\Deneme\Entities\Post;
use Modules\Deneme\Http\Requests\Deneme\DenemeCreateRequest;
use Modules\Deneme\Http\Requests\Deneme\DenemeEditRequest;
use Modules\Sales\Entities\SaleInfo;


class DenemeController extends Controller
{
    use HelperMethods;
    private $model = null;
    private $jsonSettings = null;

    public function __construct()
    {
        $this->model = new Deneme();
        $this->jsonSettings = $this->model->getSettings();
    }

    public function index()
    {
        $data = null;
        if ($search = \request()->input('ara')) {
            $conditions = $this->jsonSettings['searchable'];
            $data = $this->model->where(function ($query) use ($conditions, $search) {
                foreach ($conditions as $column)
                    $query->orWhere($column, 'like', '%' . $search . '%');
            })->orderByDESC('id')->paginate(10);
        } else
            $data = $this->model->orderByDESC('id')->paginate(10);

        $settings = [
            'operation' => 'list',
            'title' => 'Denemeler',
            'fields' => $this->jsonSettings['fields'],
            'model' => $this->model,
            'data' => $data,
            'route' => $this->jsonSettings['routes'],
        ];
        return view('deneme::index', compact('settings'));
    }

    public function create()
    {
        $operation_type = 'create';
        $settings = [
            'operation' => $operation_type,
            'title' => 'Deneme Ekle',
            'fields' => $this->jsonSettings['fields'],
            'model' => $this->model,
            'params' => null,
            'submitText' => 'Ekle',
            'submitAttributes' => [],
            'route' => $this->jsonSettings['routes'],
            'extra' => $this->getPluck($operation_type),
        ];
        return view('deneme::create', compact('settings'));
    }

    public function store(DenemeCreateRequest $request)
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
                case 'date_time':
                    $this->model[$key] = \Carbon\Carbon::parse($request[$key])->format($type == 'date_time' ? 'Y-m-d H:i:s' : 'Y-m-d');
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
            'title' => 'Deneme Detay',
            'fields' => $this->jsonSettings['fields'],
            'model' => $this->model,
            'route' => $this->jsonSettings['routes'],
        ];
        return view('deneme::show', compact('settings'));
    }

    public function edit($id)
    {
        $this->model = $this->model->findOrFail($id);
        $operation_type = 'edit';
        $settings = [
            'operation' => $operation_type,
            'title' => 'Deneme Düzenle',
            'fields' => $this->jsonSettings['fields'],
            'model' => $this->model,
            'params' => $this->model->id,
            'submitText' => 'Kaydet',
            'submitAttributes' => [],
            'route' => $this->jsonSettings['routes'],
            'extra' => $this->getPluck($operation_type),
        ];
        return view('deneme::edit', compact('settings'));
    }

    public function update(DenemeEditRequest $request, $id)
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
                case 'date_time':
                    $this->model[$key] = \Carbon\Carbon::parse($request[$key])->format($type == 'date_time' ? 'Y-m-d H:i:s' : 'Y-m-d');
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
            return redirect($back);
        }
        $models = $this->model->whereIn('id', $request->checked);
        session()->flash('danger', 'Seçili kayıtlar silindi.');
        return $models->delete();
    }
}
