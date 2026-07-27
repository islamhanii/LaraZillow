<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware for the controller.
     */
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function index()
    {
        return inertia('Realtor/Index', [
            'listings' => Auth::user()->listings,
        ]);
    }
}
