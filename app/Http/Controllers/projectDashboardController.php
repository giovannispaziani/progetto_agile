<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
                "id" => $id,
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
            return view('pages.error')->with("title", "errore")->with("description","Progetto non trovato");
        }
    }


    public function updateFine(Request $request)
    {
        try {

            $id_progetto = $request['id_progetto'];
            $progetto = Project::where('id', $id_progetto)->first();   //progetto in questione
            $userId = Auth::user()->id;                                //id dell'utente
    
            if($userId == $progetto->id_responsabile){   //se è il responsabile a fare questa richiesta
                $progetto->data_fine = $request['fine'];     //cambio la data di fine
                $progetto->save();                           //salvo nel db
            }
            else{                                        //se NON è il responsabile a fare questa richiesta do errore
                return view('pages.error')->with("message","ERRORE DI AUTENTICAZIONE: Utente non autorizzato");
            }
        } catch (\Throwable $th) {
            return view('pages.error')->with("message","Si è verificato un errore :-(");
        }

        return redirect()->route('project-dashboard', [$id_progetto]);   //riporto alla pagina del progetto
    }
}
