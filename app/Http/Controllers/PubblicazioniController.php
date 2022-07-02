<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pubblication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PubblicazioniController extends Controller
{
    public function index () {

        $id_ricercatore = Auth::user()->id;

        $lista_progetti = DB::table("research_groups")->where("id_ricercatore",$id_ricercatore);

        $lista_progetti_attivi = DB::table('projects')
        ->join('research_groups', 'research_groups.id_progetto', '=', 'projects.id')
        ->where('id_ricercatore',$id_ricercatore)->where("stato","in corso")
        ->get();

        $i = 0;
        $progetti_attivi = [];
        foreach ($lista_progetti_attivi as $progettoattivo) {

            $progetti_attivi[$i]['id'] = $progettoattivo->id;
            $progetti_attivi[$i]['nome'] = $progettoattivo->nome;

            $i++;

        }

                    $data = [

                        "id" => $id_ricercatore,
                        "progetti_attivi" => $progetti_attivi,

                    ];

        return view('pages.aggiungiPubblicazione')->with("title", "Aggiungi Pubblicazione")->with("data",$data);

    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function aggiungiPubblicazione(Request $request) {

        $pubblications = new Pubblication();
        $pubblications->id_autore = Auth::user()->id;
        $pubblications->id_progetto = $request['choices-button'];
        $pubblications->titolo = $request['titolo'];
        $pubblications->descrizione = $request['descrizione'];
        $pubblications->testo = $request['testo'];
        $pubblications->file_path = " ";
        $pubblications->save();

        return view('pages.pubblicazioneSuccess')->with("message","Pubblicazione aggiunta");

    }

}
