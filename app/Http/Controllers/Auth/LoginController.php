<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  
   Bu denetleyici, uygulama için kullanıcıların kimlik doğrulamasını yapar ve
   onları ana ekranınıza yönlendiriyor. Denetleyici bir özellik kullanır
   uygulamalarınıza işlevselliğini sağlamak için.
  */
  
  use AuthenticatesUsers;
  
  /**
   * Giriş yaptıktan sonra kullanıcıları yeniden yönlendirmek için.
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;
  
  protected function authenticated(Request $request, $user)
  {
    if (!$user->confirm) {
      Auth::logout();
      session()->flash('danger', 'Giriş yapabilmeniz için hesabınızın yönetici tarafından aktif edilmesi gerekmektedir.');
      return redirect()->route('login');
    } 
  }
  
  /**
   * Yeni bir denetleyici örneği oluşturun.
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }
  
  protected function validateLogin(Request $request)
  {
    $request->validate([
      $this->username() => 'required|string|max:255',
      'password' => 'required|string|min:8',
    ]);
  }
}
