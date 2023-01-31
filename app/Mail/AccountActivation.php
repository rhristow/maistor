<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $uuid, $activationKey;

    public function __construct($uuid, $activationKey) {
        $this->uuid = $uuid;
        $this->activationKey = $activationKey;
    }

    public function build() {
        return $this->subject('School - Account activation')->view('emails.accountActivation');
    }
}
