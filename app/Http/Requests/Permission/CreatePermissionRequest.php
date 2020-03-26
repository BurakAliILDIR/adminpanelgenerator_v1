<?php

namespace App\Http\Requests\Permission;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'required|unique:permissions',
    ];
  }
  
  public function attributes()
  {
    return [
      'name' => 'İzin adı',
    ];
  }
}
