<?php

namespace Modules\Sales\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function total_price($infos)
    {
        $total = 0;
        foreach ($infos as $info) {
            $total = $info->buy_price * $info->count;
        }
        return $total;
    }
}
