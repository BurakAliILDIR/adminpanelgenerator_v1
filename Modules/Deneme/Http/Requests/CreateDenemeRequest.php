<?php

namespace Modules\Deneme\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreateDenemeRequest extends FormRequest
{
  use DynamicRulesValidate;
  
  private $fields;
  
  public function __construct()
  {
    $operation = strtolower(substr('CreateDenemeRequest', 0, 6));
    $name = substr('CreateDenemeRequest', 6, -7);
    $this->fillFields($name, $operation);
  }
}
