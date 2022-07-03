<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class BudgetRicercatoreController extends Controller
{
    public function index () {

        $id = Auth::user()->id;

        if (Auth::user()->type == "Ricercatore") {

$budgetRicercatore = DB::table("budgets")->where("id_ricercatore",$id)->get();

$i = 0;
$spesericercatore = [];
foreach ($budgetRicercatore as $spesaricercatore) {

    $spesericercatore[$i]['progetto'] = $spesaricercatore->id_progetto;
    $spesericercatore[$i]['scopo'] = $spesaricercatore->scopo;
    $spesericercatore[$i]['importo'] = $spesaricercatore->budget;
    $spesericercatore[$i]['stato'] = $spesaricercatore->stato;
    $i++;

}

            $data = [

                "budget_ricercatore" => $spesericercatore

            ];

            return view('pages.budgetRicercatore')->with("title", "Budget Ricercatore")->with("data",$data);

        } else {

            return view('pages.error')->with("title", "Errore")->with("description","Non sei autorizzato ad accedere a questa pagina");
        }

        return view('pages.error')->with("title", "Errore")->with("description","Pagina non trovata");

    }

}
