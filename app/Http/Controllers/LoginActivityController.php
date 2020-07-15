<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LoginActivity;

class LoginActivityController extends Controller
{
    /*public function index()
    {
        $activities = LoginActivity::whereUserId(auth()->user()->id)->latest()->paginate(10);

        return view('login-activity::login-activity', compact('activities'));
    }*/

    public function index()
    {
        $allUsers = LoginActivity::all('user_id', 'user_name', 'username');

        $collection = collect($allUsers);
        $users = $collection->unique()->values()->sortBy('username')->all(); 
        
        return view('login-activity.login-activity', compact('users'));
    }

    public function showUserActivity(Request $request, $user_id)
    {
        $activities = LoginActivity::whereUserId($user_id)->latest()->paginate(10);

        return view('login-activity.show-user-activities', compact('activities'));
    }
}
