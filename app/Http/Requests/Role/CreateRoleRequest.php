<?php

namespace Modules\Role\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
  use DynamicRulesValidate;
  private $fields = null;
  private $operation = null;
  
  public function __construct()
  {
    $this->operation = strtolower(substr('CreateRoleRequest', 0, 6));
    $name = substr('CreateRoleRequest', 6, -7);
    $model = '\\Modules\\' . $name . '\\Models\\' . $name;
    $this->fields = (new $model())->getSettings('fields');
  }
}
