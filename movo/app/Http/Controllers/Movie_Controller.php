<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\MovieTag;
use App\Models\Tag;

class Movie_Controller extends Controller
{
    public function movieView($id)
    {
        $movie = Movie::find($id);

        $Movietags = MovieTag::where('movie_id', $id)->get();
        $tags = [];
        foreach ($Movietags as $Movietag) {
            $tag = Tag::find($Movietag->tag_id);
            $tags[] = $tag->name;
        }

        return view('movie', 
                    ['movie' => $movie,
                            'tags' => $tags
                    ]);
    }
}
