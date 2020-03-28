<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    
     Bu kontrolör şifre onaylarının ve
     davranışı dahil etmek için basit bir özellik kullanır. Keşfetmekte özgürsün
     bu özellik ve özelleştirme gerektiren tüm işlevleri geçersiz kılar.
    
    */

    use ConfirmsPasswords;

    /**
     * İstenen URL başarısız olduğunda kullanıcıları nereye yönlendirirsiniz.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Yeni bir denetleyici örneği oluşturun.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
