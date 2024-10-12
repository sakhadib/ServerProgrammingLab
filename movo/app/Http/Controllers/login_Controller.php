<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\geek;

class login_Controller extends Controller
{
    public function loginView(){
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $geek = geek::where('email', $request->email)->first();

        // echo '<pre>';
        //     print_r($geek->toArray());
        //     print_r(md5($request->password));
        // echo '</pre>';

        // die();

        if($geek->password == md5($request->password)){
            session(['geek_id' => $geek->id]);
            return redirect('/dashboard');
        }else{
            return back()->with('fail', 'Invalid email or password.');
        }
    }

    public function logout(){
        if(session()->has('geek_id')){
            session()->pull('geek_id');
        }
        return redirect('/login');
    }
}
