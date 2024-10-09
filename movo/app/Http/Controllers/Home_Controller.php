<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\UserTag;
use App\Models\Tag;

class Home_Controller extends Controller
{
    public function homeView(){
        if(session('geek_id')){
            return $this->loggedHomeView();
        }

        $movies = Movie::latest()->take(30)->get();
        return view('home',
                [
                    'movies' => $movies
                ]
    );
    }

    private function loggedHomeView(){

        $user_tags = UserTag::where('geek_id', session('geek_id'))->get();
        $tag_ids = [];
        foreach($user_tags as $user_tag){
            $tag_ids[] = $user_tag->tag_id;
        }

        $user_tagged_movies = Movie::whereHas('tags', function($query) use ($tag_ids){
            $query->whereIn('tag_id', $tag_ids);
        })->get();

        return view('home',
                [
                    'movies' => $user_tagged_movies
                ]
        );
    }
}
