<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\MovieTag;
use App\Models\Tag;
use App\Models\Watched;
use App\Models\Favourite;

class Movie_Controller extends Controller
{
    public function movieView($id)
    {
        $movie = Movie::find($id);

        $watched = false;
        $favourite = false;

        if(session('geek_id')){
            $watched = Watched::where('geek_id', session('geek_id'))
                ->where('movie_id', $id)
                ->count() > 0;

            $favourite = Favourite::where('geek_id', session('geek_id'))
                ->where('movie_id', $id)
                ->count() > 0;
        }

        $Movietags = MovieTag::where('movie_id', $id)->get();
        $tags = [];
        foreach ($Movietags as $Movietag) {
            $tag = Tag::find($Movietag->tag_id);
            $tags[] = $tag;
        }

        return view('movie', 
                    ['movie' => $movie,
                            'tags' => $tags,
                            'watched' => $watched,
                            'wishlist' => $favourite
                    ]);
    }
}
