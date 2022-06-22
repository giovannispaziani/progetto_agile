<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfiloRicercatoreController extends Controller
{
    
    public function index($id_ricercatore)
    {
        if(DB::table("users")->where("id",$id_ricercatore)->exists()){

        //$id_ricercatore = Auth::user()->id;

            $contributi = DB::table("research_groups")->where("id_ricercatore",$id_ricercatore)->pluck("id_progetto"); //eventuale cambio da $id_contributi a $id_progetto
            $progetto = DB::table("projects")->where("id",$contributi)->first();
            $pubblicazioni_scientifiche = DB::table("scientific_publications")->where("id_ricercatore",$id_ricercatore)->first();
            $ricercatore = DB::table("users")->where("id",$id_ricercatore)->pluck("id");

            //Informazioni Ricercatore
            $i = 0;
            $informazioni = [];
            foreach ($ricercatore as $id_ricercatore) {
                $ricercatore = DB::table("users")->where("id",$id_ricercatore)->first();
                $informazioni[$i]['nome_ricercatore'] = $ricercatore->name;
                $informazioni[$i]['cognome_ricercatore'] = $ricercatore->surname;
                $informazioni[$i]['email_ricercatore'] = $ricercatore->email;
                $i++;
            }

            // Contributi ricercatore nei progetti interni
            if ($progetto != null) {

                $i = 0;
                $progetti = [];
                foreach ($contributi as $id_ricercatore) {
                    $progetti[$i]['nome_progetto'] = $progetto->nome;
                    $progetti[$i]['descrizione_progetto'] = $progetto->descrizione;
                    $i++;
                }

            } else{
                return view('pages.error')->with("title", "errore")->with("description","Nessun contributo trovato");
            }   

            // Pubblicazioni esterne ricercatore
            if ($pubblicazioni_scientifiche != null) {
                $i = 0;
                $pubblicazioni_esterne = [];
                foreach ($pubblicazioni_scientifiche as $id_ricercatore) {
                    $pubblicazioni_esterne[$i]['titolo_pubblicazione'] = $pubblicazioni_scientifiche->titolo;
                    $pubblicazioni_esterne[$i]['fonte_pubblicazione'] = $pubblicazioni_scientifiche->fonte;
                    $i++;
                }

            } else{
                return view('pages.error')->with("title", "errore")->with("description","Nessuna pubblicazione esterna trovata");
            } 

                $data = [
                    "nome_ricercatore" => $ricercatore->name,
                    "cognome_ricercatore" => $ricercatore->surname,
                    "email_ricercatore" => $ricercatore->email,
                    "nome_progetto" => $progetto->nome,                    
                    "descrizione_progetto" => $progetto->descrizione,
                    "titolo_pubblicazione" => $pubblicazioni_scientifiche->titolo,
                    "fonte_pubblicazione" => $pubblicazioni_scientifiche->fonte

                    
                ];
                
                return view('pages.profiloRicercatore')->with("title", "Profilo Ricercatore")->with("data",$data);
        }    
    }
    
}