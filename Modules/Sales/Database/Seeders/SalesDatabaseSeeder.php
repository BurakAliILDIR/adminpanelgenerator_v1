<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SalesDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SalesTableSeeder::class);
        $this->call(SaleInfosTableSeeder::class);
    }
}
