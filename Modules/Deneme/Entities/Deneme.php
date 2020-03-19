<?php

namespace Modules\Deneme\Entities;

use App\Traits\ImageUploads\ImageUploads;
use App\Traits\Relations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;


class Deneme extends Model implements HasMedia
{
    use Relations, ImageUploads, SoftDeletes;

    protected $guarded = [];
    protected $table = 'deneme';
    /* TODO 1:  datetime yapılacak (edit view)*/
    /* TODO 2:  update işlemi yapılacak */
    /* TODO 3:  radio yapılacak */
    /* TODO 4:  validation yapılacak */
    protected $dates = ['created_at', 'updated_at'];
    // her alanın içine create, edit, index, show alanı eklenecek
    // fields dizisi json dosyanın içine json tipinde yazılacak
    // bu sayede extra alanlar ekleyebilir hale gelecek kullanıcı
    // daha sonrası düşünülerek yapılacak

    // hangi sayfaların olacağı ve olmicağı seçilecek
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

    private $path = '\Modules\Deneme\Tools\Fields\deneme.json';

    public function getSettings($key = null)
    {
        $json = json_decode(file_get_contents(base_path($this->path)), true);
        if ($key)
            return $json[$key];
        else
            return $json;
    }

    public function scopeDateFormat($value)
    {
        $date = Carbon::parse($value);
        return $date->format('Y-m-d');
    }

}
