<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use App\LoginActivity;
use Illuminate\Support\Str;

class LogSuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $slug = Str::slug($event->user->name, '-');

        try {

            LoginActivity::create([
                'type'          =>  'Successfully Logged In',
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
