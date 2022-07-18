<?php

namespace App\Http\Controllers;

use App\Models\SubProjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SottoProgettoController extends Controller
{
    public function index($id_progetto)
    {

        if(!Auth::guest()){
            if (Auth::user()->type == "Manager") {

                $data['users'] = DB::table("users")->select(['id','name','surname'])->whereRaw("type = 'Manager' OR type = 'Ricercatore' ")->get();
                $data['id_progetto'] = $id_progetto;
            }
        }

        return view('pages.aggiungiSottoprogetto')->with("title", "Aggiungi Sottoprogetto")->with("data",$data);
    }

    public function create(Request $request)
    {

            $userType = Auth::user()->type;

            if($userType == "Manager"){

                $subprojects = new Subprojects();
                $subprojects->id_responsabile = (int)$request['responsabile'];
                $subprojects->id_progetto = $request['id_progetto'];
                $subprojects->titolo = $request['titolo'];
                $subprojects->descrizione = $request['descrizione'];
                $subprojects->data_fine = $request['fine'];
                $subprojects->save();
            }
            else {
                return view('pages.error')->with("title", "errore")->with("ERRORE DI AUTENTICAZIONE: Utente non autorizzato");
            }

            return redirect()->route('sottoProgetti-List', [$request['id_progetto']]);

    }
}
