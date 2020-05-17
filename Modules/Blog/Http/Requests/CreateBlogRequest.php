<?php

namespace Modules\Blog\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
{
  use DynamicRulesValidate;
  
  private $fields;
  
  public function __construct()
  {
    $operation = strtolower(substr('CreateBlogRequest', 0, 6));
    $name = substr('CreateBlogRequest', 6, -7);
    $this->fillFields($name, $operation);
  }
}
