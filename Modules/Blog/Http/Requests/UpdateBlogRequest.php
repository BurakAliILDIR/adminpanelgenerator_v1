<?php

namespace Modules\Blog\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redis;

class UpdateBlogRequest extends FormRequest
{
  use DynamicRulesValidate;
  
  private $fields;
  
  public function __construct()
  {
    $operation = strtolower(substr('UpdateBlogRequest', 0, 6));
    $name = substr('UpdateBlogRequest', 6, -7);
    $this->fillFields($name, $operation);
  }
}
