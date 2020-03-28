<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bu ad alanı denetleyici rotalarınıza uygulanır.
     *                                                                
     * Ayrıca, URL oluşturucunun kök ad alanı olarak ayarlanır.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Uygulamanız için "home" yolunun yolu.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Rota modeli bağlantılarınızı, desen filtrelerinizi vb. Tanımlayın.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Uygulama için rotaları tanımlayın.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Uygulama için "web" yollarını tanımlayın.
     *                                                              
     * Bu yolların tümü oturum durumu, CSRF koruması vb. alır.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Uygulama için "api" yollarını tanımlayın.
     *                                             
     * Bu rotalar tipik olarak vatansızdır.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
