<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MilestoneController extends Controller
{
    public function index($id_sottoprogetto)
    {

        if(!Auth::guest()){

                $data['id_sottoprogetto'] = $id_sottoprogetto;

        }

        return view('pages.aggiungiMilestone')->with("title", "Aggiungi Milestone")->with("data",$data);
    }

    public function create(Request $request)
    {

            $userType = Auth::user()->type;

            if($userType == "Manager"){

                $milestones = new Milestone();
                $milestones->id_sottoprogetto = $request['id_sottoprogetto'];
                $milestones->titolo = $request['titolo'];
                $milestones->descrizione = $request['descrizione'];
                $milestones->data = $request['data'];
                $milestones->save();
            }
            else {
                return view('pages.error')->with("title", "errore")->with("ERRORE DI AUTENTICAZIONE: Utente non autorizzato");
            }

            return redirect()->route('milestone-List', [$request['id_sottoprogetto']]);

    }
}
