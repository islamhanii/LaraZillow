<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\UploadListingImagesRequest;
use App\Models\Listing;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(Listing $listing)
    {
        $listing->load([
            'images' => fn($query) => $query->select('id', 'listing_id', 'file_name')->orderBy('created_at', 'desc'),
        ]);

        return inertia('Realtor/ListingImage/Create', [
            'listing' => $listing
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UploadListingImagesRequest $request, Listing $listing)
    {
        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $file) {
                $path = Storage::disk('public')->putFile('images', $file);
                $paths[] = ['file_name' => $path];
            }

            $listing->images()->createMany($paths);
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }
}
