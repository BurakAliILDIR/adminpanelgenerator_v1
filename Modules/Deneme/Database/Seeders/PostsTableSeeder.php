<?php

namespace Modules\Deneme\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Deneme\Entities\Deneme;
use Modules\Deneme\Entities\Post;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 10)->create();
    }
}
