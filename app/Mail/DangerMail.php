<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DangerMail extends Mailable
{
  use Queueable, SerializesModels;
  
  private $info;
  
  public function __construct(string $info)
  {
    $this->info = $info;
  }
  
  public function build()
  {
    $now = Carbon::now()->format('d/m/Y H:i.s');
    
    return $this->html("$this->info <br><br> ZAMAN: $now");
  }
}
