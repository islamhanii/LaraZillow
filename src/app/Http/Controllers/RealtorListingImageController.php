<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\UploadListingImagesRequest;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('can:create,' . ListingImage::class . ',listing', only: ['create', 'store']),
            new Middleware('can:delete,image', only: ['destroy'])
        ];
    }

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->file_name);
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
