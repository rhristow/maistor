<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordRecovery extends Mailable
{
    use Queueable, SerializesModels;

    public $uuid, $forgottenPasswordKey;

    public function __construct($uuid, $forgottenPasswordKey) {
        $this->uuid = $uuid;
        $this->forgottenPasswordKey = $forgottenPasswordKey;
    }

    public function build() {
        return $this->subject('School - Forgotten Password')->view('emails.passwordRecovery');
    }
}
