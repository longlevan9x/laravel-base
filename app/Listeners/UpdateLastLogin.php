<?php

namespace App\Listeners;

use App\Models\Admins;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;

class UpdateLastLogin
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
	    /** @var Admins $user */
	    $user             = $event->user;
	    $user->last_login = Carbon::now();
	    $user->save();
    }
}
