<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class BudgetFinanziatoreController extends Controller
{
    public function index ($id_progetto) {

        if (Auth::user()->type == "Finanziatore") {

        $budgetFinanziatore = DB::table("budgets")->where("id_progetto",$id_progetto)->get();

            $i = 0;
            $spese = [];
        foreach ($budgetFinanziatore as $spesa) {

            $spese[$i]['scopo'] = $spesa->scopo;
            $spese[$i]['importo'] = $spesa->budget;
            $spese[$i]['stato'] = $spesa->stato;
            $i++;

        }

            $data = [

                "budget" => $spese

            ];

            return view('pages.budgetFinanziatore')->with("title", "Budget Finanziatore")->with("data",$data);

        } else {

            return view('pages.error')->with("title", "Errore")->with("description","Non sei autorizzato ad accedere a questa pagina");
        }

        return view('pages.error')->with("title", "Errore")->with("description","Pagina non trovata");

    }

}