<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\ValidateListingRequest;
use App\Models\Listing;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ListingController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware for the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),

            // Map policy methods via 'can' middleware:
            new Middleware('can:viewAny,' . Listing::class, only: ['index']),
            new Middleware('can:view,listing', only: ['show']),
            new Middleware('can:create,' . Listing::class, only: ['create', 'store']),
            new Middleware('can:update,listing', only: ['edit', 'update']),
            new Middleware('can:delete,listing', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Listing/Index', [
            'listings' => Listing::OrderByDesc('created_at')->paginate(12)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return inertia('Listing/Show', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the form for creating a new listing.
     */
    public function create()
    {
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateListingRequest $request)
    {
        $request->user()->listings()->create($request->validated());

        return redirect()->route('listing.index')->with('success', 'Listing created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia('Listing/Edit', [
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateListingRequest $request, Listing $listing)
    {
        $listing->update($request->validated());

        return redirect()->route('listing.index')->with('success', 'Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('listing.index')->with('success', 'Listing deleted successfully.');
    }
}
