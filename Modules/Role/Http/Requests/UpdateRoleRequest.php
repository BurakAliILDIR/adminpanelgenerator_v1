<?php

namespace Modules\Role\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
  use DynamicRulesValidate;
  private $fields = null;
  private $operation = null;
  
  public function __construct()
  {
    $this->operation = strtolower(substr('UpdateRoleRequest', 0, 6));
    $name = substr('UpdateRoleRequest', 6, -7);
    $model = '\\Modules\\' . $name . '\\Models\\' . $name;
    $this->fields = (new $model())->getSettings('fields');
  }
}
