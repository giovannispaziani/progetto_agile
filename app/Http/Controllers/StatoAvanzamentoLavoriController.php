<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatoAvanzamentoLavoriController extends Controller
{

    public function index($id_progetto){

        $progetto = DB::table("projects")->where("id",$id_progetto)->first();
        
        //foreach ($sottoprogetti as $sottoprogetto) {
        
            //$responsabile = DB::table("users")->where("id",$sottoprogetto->id_responsabile)->first();
        
            //$lista[$i]['id'] = $sottoprogetto->id;
            //$lista[$i]['titolo'] = $sottoprogetto->titolo;
            //$lista[$i]['descrizione'] = $sottoprogetto->descrizione;
            //$lista[$i]['termine'] = $sottoprogetto->data_fine;
            //$lista[$i]['responsabile'] = $sottoprogetto->id_responsabile;
            //$lista[$i]['nome_responsabile'] = $responsabile->name." ".$responsabile->surname;
            //$i++;
        
        //}
        
                    $data = [
        
                        "id_progetto" => $id_progetto,
                        "nome_progetto" => $progetto->nome,
                        "descrizione_progetto" => $progetto->descrizione,
                        "data_inizio" => $progetto->data_inizio,
                        "data_fine" => $progetto->data_fine
                    ];
        
                return view('pages.statoAvanzamentoLavori')->with("title", "Stato Avanzamento Lavori")->with("data",$data);


    }

}