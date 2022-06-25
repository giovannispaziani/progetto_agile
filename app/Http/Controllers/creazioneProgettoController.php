<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class creazioneProgettoController extends Controller
{
    public function index()
    {
        return view('pages.creazioneProgetto');
    }

    public function create(Request $request)
    {
        try {
            $userType = Auth::user()->type;
    
            if($userType == "Manager"){
                $progetto = new Project();
                $progetto->id_responsabile = Auth::user()->id;
                $progetto->nome = $request['nome'];
                $progetto->descrizione = $request['descrizione'];
                $progetto->data_inizio = $request['inizio'];
                $progetto->data_fine = $request['fine'];
                $progetto->stato = 'in corso';
                $progetto->save();
            }
            else{
                return view('pages.error')->with("title", "errore")->with("ERRORE DI AUTENTICAZIONE: Utente non autorizzato");
            }
        } catch (\Throwable $th) {
            return view('pages.error')->with("title", "errore")->with("Si è verificato un errore :-(");
        }

        return view('pages.creazioneProgettoSuccess')->with("message","Progetto creato con successo");
    }
}
