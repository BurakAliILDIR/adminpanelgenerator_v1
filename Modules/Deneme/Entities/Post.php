<?php

namespace Modules\Deneme\Entities;

use App\Traits\Relations;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Entities\SaleInfo;

class Post extends Model
{
    use Relations;
    public $fields = [
        'id' => [
            'id' => 'id',
            'type' => 'hidden',
            'title' => 'id',
            'name' => 'id',
            'value' => '',
            'image' => false,
            'file' => false,
            'create' => false,
            'edit' => true,
            'list' => false,
            'detail' => true,
        ],
        'name' => [
            'id' => 'name',
            'type' => 'text',
            'title' => 'Ad',
            'name' => 'name',
            'value' => '',
            'attributes' => [],
            'image' => false,
            'file' => false,
            'create' => true,
            'edit' => true,
            'list' => true,
            'detail' => true,
        ],
        'denemeler' => [
            'id' => 'denemeler',
            'type' => 'multi_checkbox',
            'title' => 'Denemeler',
            'name' => 'denemeler',
            'relationship' => [
                'type' => 'belongsToMany',
                'model' => Deneme::class,
                'fields' => ['id', 'ad', 'yas', 'soyad'],
                'keys' => ['table' => 'deneme_post', 'foreignKey' => 'post_id', 'otherKey' => 'deneme_id'],
            ],
            'attributes' => [],
            'image' => false,
            'file' => false,
            'create' => true,
            'edit' => true,
            'list' => true,
            'detail' => true,
        ],
    ];
}
