<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware for the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('can:delete,listing', only: ['destroy'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = [
            'deleted' => request()->boolean('deleted'),
            ...request()->only(['by', 'order']),
        ];

        return inertia('Realtor/Index', [
            'listings' => Auth::user()->listings()->filter($filters)->get(),
            'filters' => $filters
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing deleted successfully.');
    }
}
