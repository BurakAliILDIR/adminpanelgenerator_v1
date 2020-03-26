<?php

namespace App\Http\Requests\Permission;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'required',
    ];
  }
  
  public function attributes()
  {
    return [
      'name' => 'İzin adı',
    ];
  }
}
