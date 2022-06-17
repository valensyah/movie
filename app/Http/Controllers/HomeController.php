<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        $date = Carbon::now()->subDays(21);
        $from = $date->format('Y-m-d');
        $now = Carbon::now()->format('Y-m-d');

        $genre = Genre::limit(12)->get();
        $movie_series = Movie::where('is_movie', 0)->get();
        $movie_top = Movie::where('vote_average', '>', '7.5')->orderBy('release', 'desc')->get();
        $movie_now = Movie::whereBetween('release', [$from, $now])->orderBy('release', 'desc')->get();
        $movie_upcoming = Movie::whereDate('release', '>', $now)->orderBy('release', 'asc')->get();

        return view('landing-page.page.home', compact('genre', 'movie_top', 'movie_now', 'movie_upcoming', 'movie_series'));
    }

    public function slider()
    {
        $data = Movie::select('title', 'backdrop_path')->get();
        // $data = ['fakmfad', 'asdada'];

        return response()->json($data);
    }
}
