<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'title', 
        'vote_count',
        'vote_average',
        'popularity',
        'poster_path',
        'backdrop_path',
        'genre_ids',
        'release',
        'synopsis'
    ];
}
