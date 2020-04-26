<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))
            ->first();

        if (! $user) {
            return redirect('/threads')->with('flash', 'Unknonw token.');
        }

        $user->confirm();

        return redirect('/threads')
            ->with('flash', 'Your account is now confirmed.');
    }
}
