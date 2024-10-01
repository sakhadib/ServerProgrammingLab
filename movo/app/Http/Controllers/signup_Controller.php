<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\geek;

class signup_Controller extends Controller
{
    public function signupView(){
        return view('signup');
    }

    public function signup(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:geeks',
            'password' => 'required'
        ]);

        $geek = new geek();
        $geek->name = $request->name;
        $geek->email = $request->email;
        $geek->password = md5($request->password);
        $geek->save();

        return redirect('/login');
    }
}
