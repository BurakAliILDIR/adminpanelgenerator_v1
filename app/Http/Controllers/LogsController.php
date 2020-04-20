<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
  public function index()
  {
    $data = null;
    if ($search = trim(\request()->input('ara'))) {
      $conditions = ['id', 'subject_id', 'subject_type', 'causer_id', 'description', 'created_at'];
      $data = Activity::where(function ($query) use ($conditions, $search) {
        foreach ($conditions as $column)
          $query->orWhere($column, 'like', '%' . $search . '%');
      })->orderByDESC('id')->paginate(7);
    } else {
      $data = Activity::orderByDESC('id')->paginate(7);
    }
    return view('admin.logs.index', compact('data'));
  }
}
