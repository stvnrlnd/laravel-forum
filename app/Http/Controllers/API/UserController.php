<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $search = request('name');

        return User::where('name', 'LIKE', "%$search%")
            ->get()
            ->take(5);
    }
}
