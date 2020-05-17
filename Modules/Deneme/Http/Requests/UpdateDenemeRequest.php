<?php

namespace Modules\Deneme\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDenemeRequest extends FormRequest
{
  use DynamicRulesValidate;
  
  private $fields;
  
  public function __construct()
  {
    $operation = strtolower(substr('UpdateDenemeRequest', 0, 6));
    $name = substr('UpdateDenemeRequest', 6, -7);
    $this->fillFields($name, $operation);
  }
}
