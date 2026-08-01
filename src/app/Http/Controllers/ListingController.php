<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);

        return inertia('Listing/Index', [
            'filters' => $filters,
            'listings' => Listing::filter($filters)->mostRecent()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $listing->load([
            'images' => function ($query) {
                $query->select('listing_id', 'file_name')->orderBy('created_at', 'desc');
            }
        ]);

        return inertia('Listing/Show', [
            'listing' => $listing
        ]);
    }
}
