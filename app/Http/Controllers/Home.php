<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }
    */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*if (Auth::user()->id) {
            return view('dashboard');
        } else {*/
            return view('home');
        #}
    }
}
