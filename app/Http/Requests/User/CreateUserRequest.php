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
      'email' => 'required|email:rfc,dns,strict,spoof,filter|unique:users,email',
      'password' => 'required|min:8|confirmed|string',
      'bio' => 'nullable',
      'phone' => 'nullable|phone:TR,AUTO', // ISO 3166-1 alpha-2 code country
      'gender' => 'string',
      'date_of_birth' => 'nullable',
      'confirm' => 'boolean',
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
      'bio' => 'Hakkımda',
      'phone' => 'Telefon',
      'gender' => 'Cinsiyet',
      'date_of_birth' => 'Doğum Tarihi',
      'confirm' => 'Hesap Durumu',
      'profile' => 'Profil Fotoğrafı',
    ];
  }
}
