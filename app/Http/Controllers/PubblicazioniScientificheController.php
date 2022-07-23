<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ScientificPublication;
use Illuminate\Support\Facades\Auth;

class PubblicazioniScientificheController extends Controller
{
    public function index () {
        return view('pages.pubblicazioniScientifiche');
    }

    public function __construct() {
        $this->middleware('auth');
    }

    public function aggiungiPubblicazioneScientifica(Request $request) {

        $id_ricercatore =  Auth::user()->id;

        $scientific_publications = new ScientificPublication();
        $scientific_publications->id_ricercatore = $id_ricercatore;
        $scientific_publications->titolo = $request['titolo'];
        $scientific_publications->descrizione = $request['descrizione'];
        $scientific_publications->testo = $request['testo'];
        $scientific_publications->fonte = $request['fonte'];
        $scientific_publications->save();

    return view('pages.pubblicazioneSuccess')->with("message","Pubblicazione aggiunta");


    }


    public function eliminaPubblicazione($id)
    {
        
        try {

            $pubblicazione = ScientificPublication::where('id', $id)->first();   //pubblicazione in questione

            if(Auth::user()->id == $pubblicazione->id_ricercatore){                     //se è l'autore a fare questa richiesta
                $pubblicazione->delete();
            }
            else{                                        //se NON è l'autore a fare questa richiesta do errore
                return response('',403);
            }
        } catch (\Throwable $th) {
            return view('pages.error')->with("title", "errore")->with("description","Si è verificato un errore :-(");
        }

        return redirect('users/'.(Auth::user()->id));   //riporto alla pagina del profilo
    }


}
