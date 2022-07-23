<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class ProfiloRicercatoreController extends Controller
{

    public function index($id)
    {
        if (DB::table("users")->where("id", $id)->exists()) {

            if (DB::table("users")->where("id", $id)->where("type", "Ricercatore")) {

                $ricercatore = DB::table("users")->where("id", $id)->first();

                $scientifiche = DB::table("scientific_publications")->where("id_ricercatore", $id)->get();

                $pubblicazioni = DB::table("pubblications")->where("id_autore", $id)->get();

                $i = 0;
                $pubblicazionisc = [];
                foreach ($scientifiche as $pubblicazionesc) {

                    $pubblicazionisc[$i]['titolosc'] = $pubblicazionesc->titolo;
                    $pubblicazionisc[$i]['descrizionesc'] = $pubblicazionesc->descrizione;
                    $pubblicazionisc[$i]['testosc'] = $pubblicazionesc->testo;
                    $pubblicazionisc[$i]['fontesc'] = $pubblicazionesc->fonte;
                    $i++;
                }

                $i = 0;
                $pubblicazionipr = [];
                foreach ($pubblicazioni as $pubblicazionepr) {

                    $pubblicazionipr[$i]['titolopr'] = $pubblicazionepr->titolo;
                    $pubblicazionipr[$i]['progettopr'] = $pubblicazionepr->id_progetto;
                    $pubblicazionipr[$i]['descrizionepr'] = $pubblicazionepr->descrizione;
                    $pubblicazionipr[$i]['testopr'] = $pubblicazionepr->testo;
                    $pubblicazionipr[$i]['fileName'] = $pubblicazionepr->file_path;
                    $i++;
                }

                $data = [

                    "id" => $id,
                    "name" => $ricercatore->name,
                    "surname" => $ricercatore->surname,
                    "studi" => $ricercatore->studi,
                    "occupazione" => $ricercatore->occupazione,
                    "email" => $ricercatore->email,
                    "linkedin" => $ricercatore->linkedin,
                    "pubblicazioni_scientifiche" => $pubblicazionisc,
                    "pubblicazioni_progetti" => $pubblicazionipr

                ];

                return view('pages.profiloRicercatore')->with("title", "Profilo Ricercatore")->with("data", $data);
            } else if (DB::table("users")->where("id", $id)->where("type", "Manager")) {

                $manager = DB::table("users")->where("id", $id)->first();

                $data = [

                    "id" => $id,
                    "name" => $manager->name,
                    "surname" => $manager->surname,
                    "studi" => $manager->studi,
                    "occupazione" => $manager->occupazione,
                    "email" => $manager->email,
                    "linkedin" => $manager->linkedin

                ];

                return view('pages.profiloManager')->with("title", "Profilo Manager")->with("data", $data);
            } else if (DB::table("users")->where("id", $id)->where("type", "Finanziatore")) {

                $manager = DB::table("users")->where("id", $id)->first();

                $data = [

                    "id" => $id,
                    "name" => $manager->name,
                    "surname" => $manager->surname,
                    "studi" => $manager->studi,
                    "occupazione" => $manager->occupazione,
                    "email" => $manager->email,
                    "linkedin" => $manager->linkedin

                ];

                return view('pages.profiloFinanziatore')->with("title", "Profilo Finanziatore")->with("data", $data);
            }
        }
        return view('pages.error')->with("title", "Errore")->with("description", "Utente non trovato");
    }

    public function download(Request $request, $fileName)

    {

        $path = storage_path('app/' . $fileName);
        if (file_exists($path)) {
            return response(
                file_get_contents($path),
                200,
                [
                    'Content-Type' => 'application/octet-stream',
                    "Content-disposition" => "attachment; filename=\"".$fileName. "\""
                ]
            );
        }
        else{
            return view('pages.error')->with("title", "Errore")->with("description", "File mancante");
        }

    }
}