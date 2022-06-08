<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicatio

class AddPublicationController extends Controller
{
    public function index () {

        return view('ricercatore.pubblicazioniRicercatore');

    }

    public function addPubblicazione (Request $request) {

        $publication = new Publication();

    }

}
