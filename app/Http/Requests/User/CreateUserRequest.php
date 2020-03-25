<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'required',
      'surname' => 'required',
      'email' => 'unique:users|email|required',
      'password' => '',
      'bio' => 'string',
      'phone' => 'string',
      'gender' => 'string',
      'date_of_birth' => 'string',
      'confirm' => '',
      'profile' => 'mimes:jpeg,jpg,png',
    ];
  }
  
  public function attributes()
  {
    return [
      'name' => 'Ad',
      'surname' => 'Soyad',
      'email' => 'E-posta',
      'password' => 'Parola',
      'bio' => 'Hakkında',
      'phone' => 'Telefon',
      'gender' => 'Cinsiyet',
      'date_of_birth' => 'Doğum Tarihi',
      'confirm' => 'Onay',
    ];
  }
}
