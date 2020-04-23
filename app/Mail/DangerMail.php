<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DangerMail extends Mailable
{
  use Queueable, SerializesModels;
  
  private $page;
  private $request;
  
  public function __construct(string $page, $request)
  {
    $this->page = $page;
    $this->request = $request;
  }
  
  public function build()
  {
    $now = Carbon::now()->format('d/m/Y H:i.s');

      $req = $this->request;
    
    return $this->html("<h1>$this->page kullanıldı.</h1><br><br><h1>Zaman : $now</h1><br><br>$req");
  }
}
