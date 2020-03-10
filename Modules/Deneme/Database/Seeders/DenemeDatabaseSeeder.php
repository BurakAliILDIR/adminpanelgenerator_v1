<?php

namespace Modules\Deneme\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DenemeDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DenemeTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(DenemePostTableSeeder::class);
    }
}
