<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Bu uygulama için güvenilir proxy'ler.
     *
     * @var array|string
     */
    protected $proxies;

    /**
     * Proxy'leri algılamak için kullanılması gereken başlıklar.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
