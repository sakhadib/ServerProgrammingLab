<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\geek;
use App\Models\Tag;
use App\Models\userChoiceGiven;
use App\Models\UserTag;

class dashboard_Controller extends Controller
{
    public function dashboardView(){

        if(!session()->has('geek')){
            return redirect('/login');
        }

        $geek = geek::where('id', session('geek_id'))->first();

        $given = userChoiceGiven::where('user_id', $geek->id)->get();

        if($given->count() == 0){
            $tags = Tag::all();
            return view('selector', ['tags' => $tags]);
        }

        return view('dashboard');
    }

    public function genreChoice(Request $request){
        $geek_id = session('geek_id');

        $request->validate([
            'tags' => 'required'
        ]);

        foreach($request->tags as $tag){
            $userTag = new UserTag();
            $userTag->geek_id = $geek_id;
            $userTag->tag_id = $tag;
            $userTag->save();
        }

        $userGiven = new userChoiceGiven();
        $userGiven->user_id = $geek_id;
        $userGiven->save();

        return redirect('/dashboard');
    }
}
