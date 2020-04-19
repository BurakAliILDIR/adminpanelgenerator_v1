<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Bu dosya, tüm Closure tabanlı konsol komutlarınızı tanımlayabileceğiniz yerdir.
| Her Kapatma, her komutun IO yöntemleriyle etkileşimde bulunmak için basit bir yaklaşıma 
| izin veren bir komut örneğine bağlıdır.
|
*/

Artisan::command('inspire', function () {
  $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
