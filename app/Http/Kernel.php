<?php

namespace App\Http;

use App\Http\Middleware\ApplicationSettingsGuard;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckForMaintenanceMode;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;
use Fruitcake\Cors\HandleCors;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;

class Kernel extends HttpKernel
{
  /**
   * Uygulamanın global HTTP ara katman yığını.
   * Bu ara katman yazılımı, uygulamanıza her istekte çalıştırılır.
   * @var array
   */
  protected $middleware = [
    TrustProxies::class,
    HandleCors::class,
    CheckForMaintenanceMode::class,
    ValidatePostSize::class,
    TrimStrings::class,
    ConvertEmptyStringsToNull::class,
  
  ];
  
  /**
   * Uygulamanın yol ara katman grupları.
   * @var array
   */
  protected $middlewareGroups = [
    'web' => [
      EncryptCookies::class,
      AddQueuedCookiesToResponse::class,
      StartSession::class,
      // \Illuminate\Session\Middleware\AuthenticateSession::class,
      ShareErrorsFromSession::class,
      VerifyCsrfToken::class,
      SubstituteBindings::class,
    ],
    
    'api' => [
      'throttle:60,1',
      SubstituteBindings::class,
    ],
  ];
  
  /**
   * Uygulamanın rota ara katman yazılımı.
   * Bu ara katman yazılımı gruplara atanabilir veya ayrı ayrı kullanılabilir.
   * @var array
   */
  protected $routeMiddleware = [
    'auth' => Authenticate::class,
    'auth.basic' => AuthenticateWithBasicAuth::class,
    'bindings' => SubstituteBindings::class,
    'cache.headers' => SetCacheHeaders::class,
    'can' => Authorize::class,
    'guest' => RedirectIfAuthenticated::class,
    'password.confirm' => RequirePassword::class,
    'signed' => ValidateSignature::class,
    'throttle' => ThrottleRequests::class,
    'verified' => EnsureEmailIsVerified::class,
    'role' => RoleMiddleware::class,
    'permission' => PermissionMiddleware::class,
    'role_or_permission' => RoleOrPermissionMiddleware::class,
    'application_settings_guard' => ApplicationSettingsGuard::class,
  ];
}
