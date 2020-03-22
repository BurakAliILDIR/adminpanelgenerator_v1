<?php

namespace Modules\Deneme\Entities;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;


class Deneme extends Model implements HasMedia
{
    use Relations, MediaUploads, SoftDeletes;

    protected $guarded = [];
    protected $table = 'deneme';
    /* TODO 1:  */

    // her alanın içine create, edit, index, show alanı eklenecek
    // fields dizisi json dosyanın içine json tipinde yazılacak
    // bu sayede extra alanlar ekleyebilir hale gelecek kullanıcı
    // daha sonrası düşünülerek yapılacak

    // hangi sayfaların olacağı ve olmicağı seçilecek

    private $path = '\Modules\Deneme\Source\deneme.json';

    public function getSettings($key = null)
    {
        $json = json_decode(file_get_contents(base_path($this->path)), true);
        if ($key)
            return $json[$key];
        else
            return $json;
    }
}
