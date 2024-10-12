<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Watched;
use App\Models\Favourite;

class MovieManage_Controller extends Controller
{
    public function addWatched(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|integer'
        ]);
        $watched = new Watched();
        $watched->geek_id = session('geek_id');
        $watched->movie_id = $request->movie_id;
        $watched->save();

        return redirect('/movie/'.$request->movie_id);
    }

    public function removeWatched(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|integer'
        ]);
        Watched::where('geek_id', session('geek_id'))
            ->where('movie_id', $request->movie_id)
            ->delete();

        return redirect('/movie/'.$request->movie_id);
    }

    public function addFavourite(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|integer'
        ]);
        $favourite = new Favourite();
        $favourite->geek_id = session('geek_id');
        $favourite->movie_id = $request->movie_id;
        $favourite->save();

        return redirect('/movie/'.$request->movie_id);
    }

    public function removeFavourite(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|integer'
        ]);
        Favourite::where('geek_id', session('geek_id'))
            ->where('movie_id', $request->movie_id)
            ->delete();

        return redirect('/movie/'.$request->movie_id);
    }


}
