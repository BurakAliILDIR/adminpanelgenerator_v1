<?php

namespace Modules\Deneme\Entities;

use App\Traits\Relations;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Relations;

    private $path = '\Modules\Deneme\Tools\Fields\post.json';

    public function getFields()
    {
        return json_decode(file_get_contents(base_path($this->path)), true);
    }
}
