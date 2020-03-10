<?php

namespace Modules\Deneme\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Deneme\Entities\Deneme;

class DenemePostTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i < 60; $i++) {
            DB::table('deneme_post')->insert([
                'deneme_id' => rand(1, 10),
                'post_id' => rand(1, 10),
                'value' => 'value - ' . $i,
            ]);
        }
    }
}
