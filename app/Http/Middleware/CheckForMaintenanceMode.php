<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * Bakım modu etkinken erişilebilmesi gereken URI'ler.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
