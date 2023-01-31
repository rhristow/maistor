<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
// Models //
use App\Models\User;

class PageController extends Controller
{
    // PUBLIC PAGES //
    public function showHome() {
         return view('public/home');
    }

    // GUEST PAGES //
    public function showRegister() {
        return view('public/user/auth/register');
    }

    public function showLogin() {
        return view('public/user/auth/login');
    }

    public function showForgottenPassword() {
        return view('public/user/auth/forgotten-password');
    }

    public function showChangeForgottenPassword($uuid, $forgottenPasswordKey) {
        $user = User::where('uuid', $uuid)->first();
        if(empty($user) || $user->forgottenPasswordKey != $forgottenPasswordKey) {
            return redirect('/login');
        }
        return view('public/user/auth/change-forgotten-password')->with([
            'uuid'                  => $uuid,
            'forgottenPasswordKey'  => $forgottenPasswordKey
        ]);
    }

    // USER PAGES //
    public function showDashboard() {
        return view('public/user/dashboard/dashboard')->with([
            'stats' => [
                'StatisticsData1' => rand(1, 100),
                'StatisticsData2' => rand(1, 100),
                'StatisticsData3' => rand(1, 100)
            ]
        ]);
    }

    public function showAccount() {
        $socials = auth()->user()->socials;
        return view('public/user/account/account')->with([
            'user' => auth()->user()->load('logs')
        ]);
    }
}
