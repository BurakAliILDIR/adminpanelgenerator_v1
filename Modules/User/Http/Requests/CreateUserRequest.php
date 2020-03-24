<?php

namespace Modules\User\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
  use DynamicRulesValidate;
  private $fields = null;
  private $operation = null;
  
  public function __construct()
  {
    $this->operation = strtolower(substr('CreateUserRequest', 0, 6));
    $name = substr('CreateUserRequest', 6, -7);
    $model = '\\Modules\\' . $name . '\\Models\\' . $name;
    $this->fields = (new $model())->getSettings('fields');
  }
}