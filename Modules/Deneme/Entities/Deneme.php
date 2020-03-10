<?php

namespace Modules\Deneme\Entities;

use App\Traits\Relations;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Entities\SaleInfo;

class Deneme extends Model
{
    use Relations;

    protected $table = 'deneme';
    // her alanın içine create, edit, index, show alanı eklenecek
    // fields dizisi json dosyanın içine json tipinde yazılacak
    // bu sayede extra alanlar ekleyebilir hale gelecek kullanıcı
    // daha sonrası düşünülerek yapılacak

    // hangi sayfaların olacağı ve olmicağı seçilecek
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
        'ad' => [
            'id' => 'ad',
            'type' => 'text',
            'title' => 'Ad',
            'name' => 'ad',
            'value' => '',
            'attributes' => [],
            'image' => false,
            'file' => false,
            'create' => true,
            'edit' => true,
            'list' => true,
            'detail' => true,
        ],
        'soyad' => [
            'id' => 'soyad',
            'type' => 'text',
            'title' => 'Soyad',
            'name' => 'soyad',
            'value' => '',
            'attributes' => [],
            'image' => false,
            'file' => false,
            'create' => true,
            'edit' => true,
            'list' => true,
            'detail' => true,
        ],
        'yas' => [
            'id' => 'yas',
            'type' => 'number',
            'title' => 'Yaş',
            'name' => 'yas',
            'value' => '',
            'attributes' => [],
            'image' => false,
            'file' => false,
            'create' => true,
            'edit' => true,
            'list' => true,
            'detail' => true,
        ],
        'oylesine' => [
            'id' => 'oylesine',
            'type' => 'select',
            'title' => 'oylesine',
            'name' => 'oylesine',
            'value' => null,
            'selected' => '96',
            'relationship' => [
                'type' => 'hasMany',
                'model' => SaleInfo::class,
                'fields' => ['id', 'buy_price'],
                'keys' => ['foreignKey' => 'count_id', 'otherKey' => 'count'],
            ],
            // model içerisinde function oluşturup items alanındaki parametreleri içerisine tur alanına göre
            // değiştirip view? hangisi alanında çekilecek
            // Relationship problemi bu şekilde kalkmış olacak
            'attributes' => [],
            'image' => false,
            'file' => false,
            'create' => true,
            'edit' => true,
            'list' => true,
            'detail' => true,
        ],
        'cv' => [
            'id' => 'cv',
            'type' => 'file',
            'title' => 'CV',
            'name' => 'cv',
            'value' => '',
            'attributes' => [],
            'image' => false,
            'file' => true,
            'create' => true,
            'edit' => true,
            'list' => true,
            'detail' => true,
        ],
        'kontrol' => [
            'id' => 'checkbox',
            'type' => 'multi_checkbox',
            'title' => 'Kontrol',
            'name' => 'kontrol',
            'value' => [
                'alan1' => ['Alan 1', 1,],
                'alan2' => ['Alan 2', 2,],
                'alan3' => ['Alan 3', 3,],
            ],
            'relationship' => [
                'type' => 'belongsToMany',
                'model' => Post::class,
                'fields' => ['id', 'name'],
                'keys' => ['table' => 'deneme_post', 'foreignKey' => 'deneme_id', 'otherKey' => 'post_id'],
            ],
            'attributes' => [],
            'image' => false,
            'file' => false,
            'create' => true,
            'edit' => true,
            'list' => true,
            'detail' => true,
        ],
        'durum' => [
            'id' => 'durum',
            'type' => 'checkbox',
            'title' => 'Durum',
            'name' => 'durum',
            'create' => true,
            'edit' => true,
            'list' => false,
            'detail' => true,
        ]
        /*'alan2' => [
            'id' => 'alan2',
            'type' => 'select',
            'title' => 'Alan 2',
            'name' => 'alan2',
            'value' => ['aaa', 'bbb', 'ccc'],
            'selected' => 1,
            'attributes' => [],
        ],
        'alan3' => [
            'id' => 'alan3',
            'type' => 'radio',
            'title' => 'Alan 3',
            'name' => 'alan3',
            'value' => '111',
            'attributes' => [],
        ],
        'alan4' => [
            'id' => 'alan4',
            'type' => 'radio',
            'title' => 'Alan 4',
            'name' => 'alan3',
            'value' => '222',
            'attributes' => [],
        ],
        'alan5' => [
            'id' => 'alan5',
            'type' => 'file',
            'title' => 'Alan 5',
            'name' => 'alan5',
            'attributes' => [],
        ],
        'alan6' => [
            'id' => 'alan6',
            'type' => 'password',
            'title' => 'Alan 6',
            'name' => 'alan6',
            'attributes' => [],
        ],*/
    ];
}
