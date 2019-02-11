<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $authen_key;

	/**
	 * Create a new message instance.
	 * @param $email
	 * @param $password
	 * @param $authen_key
	 */
    public function __construct($email, $password, $authen_key)
    {
        $this->email = $email;
        $this->password = $password;
        $this->authen_key = $authen_key;
    }

	/**
	 * Build the message.
	 * @return $this
	 * @throws \Exception
	 */
    public function build()
    {
    	return $this->subject('Tin nhan dang ky tu vias.com')->from(setting(KEY_ADMIN_EMAIL) ?? config('mail.username'))->view('mailer.auth.registered')->text('mailer.auth.registered-text');
    }
}
