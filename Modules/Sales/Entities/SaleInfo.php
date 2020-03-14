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

    /*    "oylesine": {
        "id": "oylesine",
        "type": "select",
        "title": "oylesine",
        "name": "oylesine",
        "value": null,
        "multiple": true,
        "relationship": {
            "type": "hasMany",
            "model": "Modules\\Sales\\Entities\\SaleInfo",
            "fields": [
                "buy_price"
            ],
            "keys": {
                "foreignKey": "count_id",
                "otherKey": "count"
            },
            "paginate": false,
            "perPage": 10
        },
        "attributes": [],
        "create": true,
        "edit": true,
        "list": true,
        "detail": true
    }
*/
}
