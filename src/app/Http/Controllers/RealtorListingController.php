<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;

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
        return inertia('Realtor/Index');
    }
}
