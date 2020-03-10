<?php

namespace Modules\Deneme\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Deneme\Entities\Deneme;

class DenemeTableSeeder extends Seeder
{
    public function run()
    {
        factory(Deneme::class, 10)->create();
    }
}
