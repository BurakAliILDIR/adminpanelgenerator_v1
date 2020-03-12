<?php

namespace Modules\Deneme\Entities;

use App\Traits\Relations;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Entities\SaleInfo;

class Post extends Model
{
    use Relations;
}
