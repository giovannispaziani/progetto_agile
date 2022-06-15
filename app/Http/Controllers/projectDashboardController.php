<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class projectDashboardController extends Controller
{

    public function index($id)
    {
        if(DB::table("projects")->where("id",$id)->exists()){

            $progetto = DB::table("projects")->where("id",$id)->first();
            $responsabile = DB::table("users")->where("id",$progetto->id_responsabile)->first();
            $research_groups = DB::table("research_groups")->where("id_progetto",$progetto->id)->pluck("id_ricercatore");
            $financial_groups = DB::table("financial_groups")->where("id_progetto",$progetto->id)->pluck("id_finanziatore");

            $i = 0;
            $ricercatori = [];
            foreach ($research_groups as $id_ricercatore) {
                $ricercatore = DB::table("users")->where("id",$id_ricercatore)->first();
                $ricercatori[$i]['id'] = $id_ricercatore;
                $ricercatori[$i]['nome'] = $ricercatore->name;
                $ricercatori[$i]['cognome'] = $ricercatore->surname;
                $i++;
            }

            $i = 0;
            $finanziatori = [];
            foreach ($financial_groups as $id_finanziatore) {
                $finanziatore = DB::table("users")->where("id",$id_finanziatore)->first();
                $finanziatori[$i]['id'] = $id_finanziatore;
                $finanziatori[$i]['nome'] = $finanziatore->name;
                $finanziatori[$i]['cognome'] = $finanziatore->surname;
                $i++;
            }

            $budgets_table = DB::table("budgets")->where("id_progetto",$progetto->id)->get();
            $i = 0;
            $budgets = [];
            foreach ($budgets_table as $budget) {
                $budgets[$i]['id'] = $budget->id;
                $budgets[$i]['scopo'] = $budget->scopo;
                $budgets[$i]['budget'] = $budget->budget;
                $i++;
            }


            $pubblicazioni_table = DB::table("pubblications")->where("id_progetto",$progetto->id)->get();
            $i = 0;
            $pubblicazioni = [];
            foreach ($pubblicazioni_table as $pubblicazione) {
                $autore = DB::table("users")->where("id",$pubblicazione->id_autore)->first();
                $pubblicazioni[$i]['id'] = $pubblicazione->id;
                $pubblicazioni[$i]['titolo'] = $pubblicazione->titolo;
                $pubblicazioni[$i]['autore'] = $autore->name;
                $i++;
            }

            $data = [
                "nome" => $progetto->nome,
                "descrizione" => $progetto->descrizione,
                "id_responsabile" => $progetto->id_responsabile,
                "responsabile" => $responsabile->name,
                "stato" => $progetto->stato,
                "data_inizio" => $progetto->data_inizio,
                "data_fine" => $progetto->data_fine,
                "ricercatori" => $ricercatori,
                "finanziatori" => $finanziatori,
                "budget" => $budgets,
                "pubblicazioni" => $pubblicazioni
            ];
            
            return view('pages.projectDashboard')->with("title", "Creazione Progetto")->with("data",$data);
        }
        else{
            return view('pages.error')->with("title", "HTTP code 404")->with("description","Progetto non trovato");
        }
    }
}
