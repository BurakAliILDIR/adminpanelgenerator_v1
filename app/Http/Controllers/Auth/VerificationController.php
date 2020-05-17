<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Email Verification Controller
  |--------------------------------------------------------------------------
  |
  | Bu denetleyici, herhangi biri için e-posta doğrulamasından sorumludur.
  | uygulamasına yeni kaydolan kullanıcı. E-postalar ayrıca
  | kullanıcı orijinal e-posta iletisini almadıysa yeniden gönderilir.
  |
  */
  
  use VerifiesEmails;
  
  /**
   * Doğrulamadan sonra kullanıcıları nereye yönlendirirsiniz.
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;
  
  /**
   * Yeni bir denetleyici örneği oluşturun.
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('signed')->only('verify');
    $this->middleware('throttle:6,1')->only('verify', 'resend');
  }
  
  /**
   * The user has been verified.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return mixed
   */
  protected function verified(Request $request)
  {
    $user = \auth()->user();
    if ($user->email_verified_at && !$user->confirm) {
      Auth::logout();
      session()->flash('info', 'Hesabınız doğrulandı. Giriş yapabilmeniz için hesabınızın yönetici tarafından aktif edilmesi gerekmektedir.');
      return redirect()->route('login');
    }
  }
}
