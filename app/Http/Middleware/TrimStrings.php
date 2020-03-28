<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * Kesilmemesi gereken özelliklerin adları.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];
}
