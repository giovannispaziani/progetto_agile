<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AggiungiVoceController extends Controller
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

        return view('pages.aggiungiVoce')->with("title", "Aggiungi Voce")->with("data",$data);

    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function aggiungiVoce(Request $request) {

        $budgets = new Budget();
        $budgets->id_progetto = $_POST['choices-button'];
        $budgets->id_ricercatore = Auth::user()->id;
        $budgets->scopo = $request['scopo'];
        $budgets->budget = $request['budget'];
        $budgets->stato = 'in attesa';
        $budgets->save();

        return view('pages.vocespesaSuccess')->with("message","Voce spesa aggiunta");

    }

}
