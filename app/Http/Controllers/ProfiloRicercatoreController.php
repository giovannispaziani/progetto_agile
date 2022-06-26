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

$ricercatore = DB::table("users")->where("id",$id_ricercatore)->first();

$scientifiche = DB::table("scientific_publications")->where("id_ricercatore",$id_ricercatore)->get();

$pubblicazioni = DB::table("pubblications")->where("id_autore",$id_ricercatore)->get();

$i = 0;
$pubblicazionisc = [];
foreach ($scientifiche as $pubblicazionesc) {

    $pubblicazionisc[$i]['titolosc'] = $pubblicazionesc->titolo;
    $pubblicazionisc[$i]['fontesc'] = $pubblicazionesc->fonte;
    $i++;

}

$i = 0;
$pubblicazionipr = [];
foreach ($pubblicazioni as $pubblicazionepr) {

    $pubblicazionipr[$i]['titolopr'] = $pubblicazionepr->titolo;
    $pubblicazionipr[$i]['progetto'] = $pubblicazionepr->id_progetto;
    $pubblicazionipr[$i]['fontepr'] = $pubblicazionepr->file_path;
    $i++;

}

            $data = [

                "id" => $id_ricercatore,
                "name" => $ricercatore->name,
                "surname" => $ricercatore->surname,
                "email" => $ricercatore->email,
                "pubblicazioni_scientifiche" => $pubblicazionisc,
                "pubblicazioni_progetti" => $pubblicazionipr

            ];

            return view('pages.profiloRicercatore')->with("title", "Profilo Ricercatore")->with("data",$data);

        } else {

            return view('pages.error')->with("title", "errore")->with("description","Profilo non trovato");
        }

    }

}