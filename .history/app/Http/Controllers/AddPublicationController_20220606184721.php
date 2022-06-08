<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Publications;

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
        $publication->save();

        return redirect('dashboardRicercatore');

    }

}
