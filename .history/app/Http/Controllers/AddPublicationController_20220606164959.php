<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;

class AddPublicationController extends Controller
{
    public function index () {

        return view('ricercatore.pubblicazioniRicercatore');

    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addPubblicazione (Request $request) {

        $publication = new Publication();
        $publication->titolo = $request['titolo'];
        $publication->fonte = $request['fonte'];
        $publication->user_id = Auth::user()->id;
        $publication->save();

        return vi

    }

}
