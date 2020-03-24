<?php

namespace Modules\Permission\Http\Requests;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
{
  use DynamicRulesValidate;
  private $fields = null;
  private $operation = null;
  
  public function __construct()
  {
    $this->operation = strtolower(substr('CreatePermissionRequest', 0, 6));
    $name = substr('CreatePermissionRequest', 6, -7);
    $model = '\\Modules\\' . $name . '\\Models\\' . $name;
    $this->fields = (new $model())->getSettings('fields');
  }
}
