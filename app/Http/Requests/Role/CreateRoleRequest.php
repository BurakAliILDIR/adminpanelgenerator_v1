<?php

namespace App\Http\Requests\Role;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'required|unique:roles',
    ];
  }
  
  public function attributes()
  {
    return [
      'name' => 'Rol adı',
    ];
  }
}
