<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'nullable',
      'surname' => 'nullable',
      'email' => 'unique:users|email|required',
      'password' => 'nullable',
      'bio' => 'nullable',
      'phone' => 'nullable|phone:AUTO,TR', // ISO 3166-1 alpha-2 code country
      'gender' => 'string',
      'date_of_birth' => 'nullable',
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
      'confirm' => 'Hesap Durumu',
      'profile' => 'Profil Fotoğrafı',
    ];
  }
}
