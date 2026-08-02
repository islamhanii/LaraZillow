<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\MakeOfferRequest;
use App\Models\Listing;
use App\Models\Offer;

class ListingOfferController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Listing $listing, MakeOfferRequest $request)
    {
        $listing->offers()->save(
            Offer::make($request->validated())
                ->bidder()
                ->associate($request->user())
        );

        return redirect()->back()->with('success', 'Offer submitted successfully.');
    }
}
