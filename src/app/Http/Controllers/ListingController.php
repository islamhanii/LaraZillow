<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\CreateListingRequest;
use App\Models\Listing;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Listing/Index', [
            'listings' => Listing::all()
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
    public function store(CreateListingRequest $request)
    {
        Listing::create($request->validated());

        return redirect()->route('listing.index')->with('success', 'Listing created successfully.');
    }
}
