<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publications;
use Illuminate\Support\Facades\Auth;

class AddPublicationController extends Controller
{
    public function index () {

        return view('ricercatore.pubblicazioniRicercatore');

    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function aggiungiPubblicazione(Request $request) {

        $publication = new Publications();
        $publication->titolo = $request['titolo'];
        $publication->fonte = $request['fonte'];
        $publication->user_idid_utente = Auth::user()->id;
        $publication->save();

        return redirect('ricercatore.dashboardRicercatore');

    }

}
