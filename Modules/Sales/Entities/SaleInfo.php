<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;

class SaleInfo extends Model
{
    protected $table = 'sale_infos';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

}
