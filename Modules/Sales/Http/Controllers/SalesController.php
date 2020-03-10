<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Deneme\Entities\Deneme;
use Modules\Sales\Entities\Sale;
use Modules\Sales\Entities\SaleInfo;

class SalesController extends Controller
{
    public function index()
    {
        dd(Deneme::pluck('ad','id'));
//        $sales = Sale::orderBy('id', 'DESC')->paginate(5);
//        return view('sales::sales.index', compact('sales'));
    }

    public function show($id)
    {
        $sale = Sale::findOrFail($id);

        return view('sales::sales.show', compact('sale'));
    }
}
