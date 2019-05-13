<?php

namespace App\Jobs;

use App\Mail\TestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TestMailJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $email;

	/**
	 * Create a new job instance.
	 * @return void
	 */
	public function __construct($email) {
		$this->email = $email;
	}

	/**
	 * Execute the job.
	 * @return void
	 */
	public function handle() {
		\Mail::to($this->email)->send(new TestMail());
	}
}