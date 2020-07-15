<?php

namespace App\Http\ViewComposers;
use App\User;
use Auth;

class NavigationViewComposer
{
    public function compose($view)
    {
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

        dd($data);

        $view->with($data);
    }
}
