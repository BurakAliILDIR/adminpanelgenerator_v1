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
      $data = Activity::whereNotIn('causer_id', [env('SUPER_ADMIN_ID')])->isNotNull('causer_id')
        ->where(function ($query) use ($conditions, $search) {
          foreach ($conditions as $column)
            $query->orWhere($column, 'like', '%' . $search . '%');
        })->orderByDESC('id')->paginate(5);
    } else {
      $data = Activity::whereNotIn('causer_id', [env('SUPER_ADMIN_ID')])
        ->whereNotNull('causer_id')->orderByDESC('id')->paginate(5);
    }
    return view('admin.logs.index', compact('data'));
  }
}
