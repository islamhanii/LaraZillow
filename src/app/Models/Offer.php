<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

#[Fillable(['amount', 'accepted_at', 'rejected_at'])]
class Offer extends Model
{
    /**
     * Get the listing associated with the offer.
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Get the user who made the offer.
     */
    public function bidder()
    {
        return $this->belongsTo(User::class, 'bidder_id');
    }

    public function scopeByMe(Builder $query): Builder
    {
        return $query->where('bidder_id', Auth::user()?->id);
    }
}
