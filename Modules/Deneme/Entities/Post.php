<?php

namespace Modules\Deneme\Entities;

use App\Traits\Relations;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Relations;

    private $path = '\Modules\Deneme\Tools\Fields\post.json';

    public function getSettings($key = null)
    {
        $json = json_decode(file_get_contents(base_path($this->path)), true);
        if ($key)
            return $json[$key];
        else
            return $json;
    }
}
