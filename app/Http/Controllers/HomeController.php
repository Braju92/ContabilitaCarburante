<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Home()
    {
        return view('home');
    }
    public function Visualizza()
    {
        return view('Visualizza');
    }
    public function Inserimento()
    {
        return view('Inserimento');
    }
    public function Elimina()
    {
        return view('Elimina');
    }
    public function Fogli()
    {
        return view('Fogli');
    }
}
