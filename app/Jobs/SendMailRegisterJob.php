<?php

namespace App\Jobs;

use App\Mail\UserRegisteredNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailRegisterJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $user;
	protected $password;

	/**
	 * Create a new job instance.
	 * @param $user
	 * @param $password
	 */
	public function __construct($user, $password) {
		$this->user     = $user;
		$this->password = $password;
	}

	/**
	 * Execute the job.
	 * @return void
	 */
	public function handle() {
		\Mail::to($this->user->email)->send(new UserRegisteredNotificationMail($this->user->email, $this->password, $this->user->authen_key));
	}
}
