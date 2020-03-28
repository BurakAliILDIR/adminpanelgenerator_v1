<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    
     Bu denetleyici şifre sıfırlama isteklerini işlemekten sorumludur
     ve bu davranışı dahil etmek için basit bir özellik kullanır. Özgürsün
     bu özelliği araştırın ve değiştirmek istediğiniz yöntemleri geçersiz kılın.
    
    */

    use ResetsPasswords;

    /**
     * Kullanıcıların şifrelerini sıfırladıktan sonra nereye yönlendirileceği.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
