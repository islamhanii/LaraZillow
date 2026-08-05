<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\MakeOfferRequest;
use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ListingOfferController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware for the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('can:create,' . Offer::class . ',listing', only: ['store'])
        ];
    }

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
