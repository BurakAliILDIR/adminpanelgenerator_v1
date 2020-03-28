<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Şifrelenmemesi gereken çerezlerin adları.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
