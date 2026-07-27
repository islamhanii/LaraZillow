<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'])]
class Listing extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the owner of the listing.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['priceFrom'] ?? false, fn($query, $value) => $query->where('price', '>=', $value))
            ->when($filters['priceTo'] ?? false, fn($query, $value) => $query->where('price', '<=', $value))
            ->when($filters['beds'] ?? false, fn($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value))
            ->when($filters['baths'] ?? false, fn($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value))
            ->when($filters['areaFrom'] ?? false, fn($query, $value) => $query->where('area', '>=', $value))
            ->when($filters['areaTo'] ?? false, fn($query, $value) => $query->where('area', '<=', $value));
    }
}
