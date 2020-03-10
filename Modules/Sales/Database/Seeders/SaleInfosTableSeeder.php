<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Entities\Sale;
use Modules\Sales\Entities\SaleInfo;

class SaleInfosTableSeeder extends Seeder
{
    public function run()
    {
        factory(SaleInfo::class, 5)->create();
    }
}
