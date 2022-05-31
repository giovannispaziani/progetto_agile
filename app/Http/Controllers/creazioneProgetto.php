<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class creazioneProgetto extends Controller
{
    public function index()
    {
        return view('pages.creazioneProgetto');
    }

    public function create(Request $request)
    {
        return $request;
    }
}
