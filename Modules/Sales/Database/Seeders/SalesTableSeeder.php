<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Entities\Sale;

class SalesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Sale::class, 5)->create();
    }
}
