<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangedPassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct() {
    }

    public function build() {
        return $this->subject('School - Changed Password')->view('emails.changedPassword');
    }
}
