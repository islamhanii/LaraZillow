<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable('file_name')]
#[Appends('url')]
class ListingImage extends Model
{
    /**
     * Get the listing that owns the image.
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Get the URL of the image.
     */
    public function url(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::disk('public')->url($this->file_name),
        );
    }
}
