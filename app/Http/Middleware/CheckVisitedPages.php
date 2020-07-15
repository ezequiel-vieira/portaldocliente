<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use App\LoginActivity;
use Illuminate\Support\Str;

use Closure;
use Auth;
use Request;

class CheckVisitedPages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $slug = Str::slug(Auth::user()->name, '-');

        $url = Request::getPathInfo() . Request::getQueryString();

        try {

                LoginActivity::create([
                    'type'          =>  $url,
                    'user_id'       =>  Auth::user()->id,
                    'user_name'     =>  Auth::user()->name,
                    'user_mail'     =>  Auth::user()->email,
                    'username'      =>  $slug,
                    'ip_address'    =>  \Illuminate\Support\Facades\Request::ip(),
                    'user_agent'    =>  \Illuminate\Support\Facades\Request::header('User-Agent')
                ]);

            } catch (\Exception $e) {
                Log::error($e);
            }

        return $next($request);
    }

}
