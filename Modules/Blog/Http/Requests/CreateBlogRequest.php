<?php

namespace Modules\Blog\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
{
  use DynamicRulesValidate;
  private $fields = null;
  private $operation = null;
  
  public function __construct()
  {
    $this->operation = substr('CreateBlogRequest', 0, 6);
    dump($this->operation);
    $name = substr('CreateBlogRequest', 6, -7);
    $model = '\\Modules\\' . $name . '\\Models\\' . $name;
    dump($model);
    $this->fields = (new $model())->getSettings('fields');
  }
}
