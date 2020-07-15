<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Auth;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('partials.*', function($view) {
            
            $userId = Auth::id();

            $account = User::find($userId)->account;

            $user = \Auth::user();

            if(empty($account)) 
            {
                $account = Auth::user();
            }

            $data = [
                'user'     => $user,
                'client'   => $account
            ];  
            
            $view->with($data);
        });
    }

}
