<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * CSRF doğrulamasından hariç tutulması gereken URI'ler.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
