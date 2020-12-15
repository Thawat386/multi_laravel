<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:director']);

    }

    public function dashboard(){

        return view('director.dashboard');
    }
}
