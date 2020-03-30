<?php

namespace App\Http\Requests\Profile;

use App\Traits\ValidationTraits\DynamicRulesValidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'nullable',
      'surname' => 'nullable',
      'email' => 'required|email|unique:users,email,' . auth()->id(),
      'password' => 'nullable|min:8|confirmed|string',
      'bio' => 'nullable',
      'phone' => 'nullable|phone:US,TR,GB', // ISO 3166-1 alpha-2 code country
      'gender' => 'string',
      'date_of_birth' => 'date',
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
      'profile' => 'Profil Fotoğrafı',
    ];
  }
}
