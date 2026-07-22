<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAccount\CreateUserAccountRequest;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware for the controller.
     */
    public static function middleware(): array
    {
        return ['guest'];
    }

    /**
     * Show the form for creating a new user account.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    /**
     * Store a newly created user account in storage.
     *
     * @param  \App\Http\Requests\UserAccount\CreateUserAccountRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserAccountRequest $request)
    {
        $user = User::create($request->validated());

        Auth::login($user);

        return redirect()->route('listing.index')
            ->with('success', 'Account created successfully.');
    }
}
