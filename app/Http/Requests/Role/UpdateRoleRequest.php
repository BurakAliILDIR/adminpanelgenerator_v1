<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
  public function rules()
  {
    return [
	    'name' => "required|unique:roles,name,$this->id",
    ];
  }
  
  public function attributes()
  {
    return [
      'name' => 'Rol adı',
    ];
  }
  
}
