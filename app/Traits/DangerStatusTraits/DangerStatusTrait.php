<?php


namespace App\Traits\DangerStatusTraits;


use App\Mail\DangerMail;
use Illuminate\Support\Facades\Mail;

trait DangerStatusTrait
{
  private function dangerStatusMailSend($page, $request = null) : void
  {
    Mail::to(config('my-config.danger_mail'))->send(new DangerMail('FieldController / Create', $request));
  }
}
