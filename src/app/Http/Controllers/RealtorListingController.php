<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\ValidateListingRequest;
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
            new Middleware('can:delete,listing', only: ['destroy']),
            new Middleware('can:create,' . Listing::class, only: ['create', 'store']),
            new Middleware('can:update,listing', only: ['edit', 'update'])
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
            'listings' => Auth::user()->listings()->filter($filters)->paginate(10)->withQueryString(),
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for creating a new listing.
     */
    public function create()
    {
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateListingRequest $request)
    {
        $request->user()->listings()->create($request->validated());

        return redirect()->route('realtor.listing.index')->with('success', 'Listing created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia('Realtor/Edit', [
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateListingRequest $request, Listing $listing)
    {
        $listing->update($request->validated());

        return redirect()->route('realtor.listing.index')->with('success', 'Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing deleted successfully.');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing restored successfully.');
    }
}
