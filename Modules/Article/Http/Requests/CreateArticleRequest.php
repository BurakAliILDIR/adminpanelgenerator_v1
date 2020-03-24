<?php

namespace Modules\Article\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
{
  use DynamicRulesValidate;
  private $fields = null;
  private $operation = null;
  
  public function __construct()
  {
    $this->operation = substr('CreateArticleRequest', 0, 6);
    dump($this->operation);
    $name = substr('CreateArticleRequest', 6, -7);
    $model = '\\Modules\\' . $name . '\\Models\\' . $name;
    dump($model);
    $this->fields = (new $model())->getSettings('fields');
  }
}
