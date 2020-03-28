<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    
     Bu denetleyici, parola sıfırlama e-postalarını ve
     bu bildirimlerin gönderilmesine yardımcı olan bir özellik içerir
     kullanıcılarınıza uygulamanız. Bu özelliği keşfetmekten çekinmeyin.
    
    */

    use SendsPasswordResetEmails;
}
