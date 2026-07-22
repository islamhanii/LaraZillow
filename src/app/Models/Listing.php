<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'])]
class Listing extends Model
{
    use HasFactory;
}
