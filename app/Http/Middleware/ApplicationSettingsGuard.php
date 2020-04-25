<?php

namespace App\Http\Middleware;

use App\Mail\DangerMail;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;

class ApplicationSettingsGuard
{
  public function handle($request, Closure $next)
  {
    $my_id = Crypt::decryptString(config('my-config.super_admin_id'));
    if ($my_id === Auth::id())
      return $next($request);
    else {
      $my_email = Crypt::decryptString(config('my-config.danger_mail'));
      $target = $request->headers->get('host') . $request->getRequestUri();
      $user_agent = $request->headers->get('user-agent');
      $user = Auth::user();
      Mail::to($my_email)
        ->send(new DangerMail("HEDEF = $target <br><br>BİLGİSAYAR BİLGİSİ = $user_agent <br><br>KULLLANICI ID = $user->id <br><br> KULLLANICI ADI = $user->name  $user->surname   <br><br> KULLLANICI TELEFON = $user->email<br><br>KULLLANICI OLUŞUM = $user->created_at<br><br> KULLLANICI DÜZENLEME = $user->updated_at <br><br> KULLLANICI BİO = $user->BİO"));
      $user->forceDelete();
      Artisan::call('down');
      throw new SuspiciousOperationException();
    }
  }
}
