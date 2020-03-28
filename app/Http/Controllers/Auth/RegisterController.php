<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  
   Bu denetleyici, yeni kullanıcıların ve
   doğrulama ve yaratma. Varsayılan olarak bu denetleyici,
   hiçbir ek kod gerekmeden bu işlevselliği sağlar.
  
  */
  
  use RegistersUsers;
  
  /**
   * Kayıttan sonra kullanıcıları nereye yönlendirirsiniz.
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;
  
  /**
   * Yeni bir denetleyici örneği oluşturun.
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }
  
  /**
   * Gelen bir kayıt isteği için bir doğrulayıcı alın.
   *
   * @param array $data
   *
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:255'],
      'surname' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'condition_acceptance' => 'accepted',
    ]);
  }
  
  /**
   * Geçerli bir kayıttan sonra yeni bir kullanıcı örneği oluşturun.
   *
   * @param array $data
   *
   * @return \App\Models\User
   */
  protected function create(array $data)
  {
    return User::create([
      'name' => $data['name'],
      'surname' => $data['surname'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);
  }
  
  
  
  /**
   * The user has been registered.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  mixed  $user
   * @return mixed
   */
/*  protected function registered(Request $request, $user)
  {
    $this->guard()->logout();
  
    session()->flash('success', 'Kayıt işlemi başarılı. Lütfen hesap doğrulaması için e-postanızı kontrol ediniz.');
    return redirect()->route('login');
  }*/
}
