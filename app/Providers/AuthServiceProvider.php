<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * Uygulama için ilke eşlemeleri.
   * @var array
   */
  protected $policies = [
    // 'App\Model' => 'App\Policies\ModelPolicy',
  ];
  
  /**
   * Kimlik doğrulama / yetkilendirme hizmetlerini kaydedin.
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();
    
    // Implicitly grant "super-admin" role all permissions
    // This works in the app by using gate-related functions like auth()->user->can() and @can()
    Gate::before(function ($user, $ability) {
      return $user->hasRole('super-admin') ? true : null;
    });
  }
}
