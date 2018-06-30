<?php

namespace App\Listeners;

use App\Models\Admins;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

class UpdateLastLogout
{
	/**
	 * Create the event listener.
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Handle the event.
	 * @param  Logout $event
	 * @return void
	 */
	public function handle(Logout $event) {
		/** @var Admins $user */
		$user             = $event->user;
		$user->last_logout = Carbon::now();
		$user->save();
	}
}
