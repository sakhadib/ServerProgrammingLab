<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\UserTag;
use App\Models\Tag;
use App\Models\Favourite;
use App\Models\Watched;
use App\Models\MovieTag;

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

    public function allMovieView(){
        $movies = Movie::all();
        return view('home',
                [
                    'movies' => $movies
                ]
        );
    }

    public function favouritesView(){
        if(!session('geek_id')){
            return redirect('/login');
        }

        $favourites = Favourite::where('geek_id', session('geek_id'))->get();
        $movie_ids = $favourites->pluck('movie_id');
        $movies = Movie::whereIn('id', $movie_ids)->get();

        return view('home',
                [
                    'movies' => $movies
                ]
        );

    }

    public function watchedView(){
        if(!session('geek_id')){
            return redirect('/login');
        }

        $watched = Watched::where('geek_id', session('geek_id'))->get();
        $movie_ids = $watched->pluck('movie_id');
        $movies = Movie::whereIn('id', $movie_ids)->get();

        return view('home',
                        [
                            'movies' => $movies
                        ]
        );
    }


    public function tagView($tag_id){
        $tag = Tag::find($tag_id);
        $movie_ids = MovieTag::where('tag_id', $tag_id)->pluck('movie_id');
        $movies = Movie::whereIn('id', $movie_ids)->get();

        return view('home',
                [
                    'movies' => $movies
                ]
        );
    }
}
