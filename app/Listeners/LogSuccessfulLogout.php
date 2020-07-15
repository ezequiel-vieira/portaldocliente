<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use App\LoginActivity;
use Illuminate\Support\Str;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //$slug = Str::slug($event->user->name, '-');
        $slug = ( isset($event->user->name) ? Str::slug($event->user->name, '-') : NULL);

        try {

            LoginActivity::create([
                'type'          =>  'Logged Out',
                'user_id'       =>  $event->user->id,
                'user_name'     =>  $event->user->name,
                'user_mail'     =>  $event->user->email,
                'username'      =>  $slug,
                'ip_address'    =>  \Illuminate\Support\Facades\Request::ip(),
                'user_agent'    =>  \Illuminate\Support\Facades\Request::header('User-Agent')
            ]);

        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
