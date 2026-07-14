<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login');
    }

    public function store(LoginRequest $request)
    {
        
    }
}
