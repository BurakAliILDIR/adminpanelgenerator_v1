<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
  /**
   * Kimliği doğrulanmadığında kullanıcının yönlendirilmesi gereken yolu alın.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return string|null
   */
  protected function redirectTo($request)
  {
    if ( !$request->expectsJson()) {
      return route('login');
    }
  }
}
