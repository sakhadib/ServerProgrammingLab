<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\geek;
use App\Models\UserTag;
use App\Models\Tag;
use App\Models\Favourite;
use App\Models\Watched;
use App\Models\Movie;

class Profile_controller extends Controller
{
    public function profileView(){
        if(!session('geek_id')){
            return redirect('/login');
        }

        $geek_id = session('geek_id');

        return $this->anyProfile($geek_id);
        
    }

    public function anyProfile($id){
        $geek = geek::find($id);

        $tags = $this->getTagsByGeekId($id);

        $favourites = Favourite::where('geek_id', $id)->get();
        $favouriteMovies = $favourites->pluck('movie_id')->toArray();
        $favouriteMovies = Movie::whereIn('id', $favouriteMovies)->get();

        


        return view('profile', 
        [
            'geek' => $geek,
            'tags' => $tags,
            'favourites' => $favouriteMovies
        ]);

        
    }

    public function getTagsByGeekId($id){
        $user_tags = UserTag::where('geek_id', $id)->get();
        $tag_ids = [];
        foreach($user_tags as $user_tag){
            $tag_ids[] = $user_tag->tag_id;
        }

        $tags = Tag::whereIn('id', $tag_ids)->get();

        return $tags;
    }
}
