<?php

namespace App\Http\Requests\User;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => '',
      'surname' => '',
      //'email' => 'unique:users|email|required',
      //'password' => '',
      'bio' => '',
      'phone' => 'phone:US,TR,GB', // ISO 3166-1 alpha-2 code country
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
      'profile' => 'Profil Fotoğrafı',
    ];
  }
}
