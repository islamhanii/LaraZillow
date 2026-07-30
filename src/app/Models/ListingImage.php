<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('file_name')]
class ListingImage extends Model
{
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
