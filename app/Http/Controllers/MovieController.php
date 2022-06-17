<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends Controller
{
    public function getGenre()
    {
        $data = Genre::get();
    
        return response()->json($data);
    }

    public function insertGenre($id, $name)
    {
        $insert = Genre::updateOrCreate(
            ['id' => $id],
            ['id' => $id, 'name' => $name]
        );

        if ($insert) {
            $res = [
                "status" => true,
                "message" => "Success Update Genre"
            ];
        } else {
            $res = [
                "status" => false,
                "message" => "Something Went Wrong!"
            ];
        }

        return response()->json($res);
    }

    public function insertMovie(Request $request)
    {
        $insert = Movie::updateOrCreate(
            ['id' => $request->id],
            [
                'id' => $request->id,
                'title' => $request->title,
                'vote_count' => $request->vote_count,
                'vote_average' => $request->vote_average,
                'popularity' => $request->popularity,
                'poster_path' => "https://image.tmdb.org/t/p/w500/$request->poster_path",
                'backdrop_path' => "https://image.tmdb.org/t/p/original/$request->backdrop_path",
                'genre_ids' => $request->genre_ids,
                'synopsis' => $request->synopsis,
                'release' => $request->release,
                'is_movie' => $request->is_movie
            ]);

        if ($insert) {
            $res = [
                "status" => true,
                "message" => "Success Update Movie"
            ];
        } else {
            $res = [
                "status" => false,
                "message" => "Something Went Wrong!"
            ];
        }

        return response()->json($res);
    }

    public function getMovieById($id)
    {
        $data = Movie::find($id);

        $genre = array();
        $genre_ids = explode(",", $data["genre_ids"]);
        foreach ($genre_ids as $g) {
            $gen = Genre::find($g);
            // dd($gen["name"]);
            array_push($genre, $gen['name']);
        }

        $genre = implode(", ", $genre);
        $data["genre"] = $genre;

        return response()->json($data);
    }

    public function updateIsMovie()
    {
        $data = DB::table('movies')->update(['is_movie' => 1]);

        return response()->json([
            "message" => "Berhasil !"
        ]);
    }
}
