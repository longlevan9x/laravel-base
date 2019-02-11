<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	/**
	 * Build the message.
	 * @return $this
	 * @throws \Exception
	 */
	public function build()
    {
	    return $this->subject("test mail: ")->from(setting(KEY_ADMIN_EMAIL) ?? config('mail.username'))->view("mailer.test")->text("mailer.test-text");
    }
}
