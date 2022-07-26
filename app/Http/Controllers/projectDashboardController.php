<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Pubblication;
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
            $pubblicazioni_number= DB::table("pubblications")->where("id_progetto",$progetto->id)->count();
            
            $spese=DB::table("budgets")->where("id_progetto",$progetto->id)->where("stato",true)->pluck("budget")->sum();
            $budget=DB::table("finanziatore")->where("id_progetto",$progetto->id)->pluck("fondo")->sum();
            $budget=$budget-$spese;

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

            $spese_table = DB::table("budgets")->where("id_progetto",$progetto->id)->get();
            $i = 0;
            $spese = [];
            foreach ($spese_table as $spesa) {
                $spese[$i]['id'] = $spesa->id;
                $spese[$i]['scopo'] = $spesa->scopo;
                $spese[$i]['budget'] = $spesa->budget;
                $i++;
            }


            $pubblicazioni_table = DB::table("pubblications")->where("id_progetto",$progetto->id)->get();
            $i = 0;
            $pubblicazioni = [];
            foreach ($pubblicazioni_table as $pubblicazione) {
                $autore = DB::table("users")->where("id",$pubblicazione->id_autore)->first();
                $pubblicazioni[$i]['fileName'] = $pubblicazione->file_path;
                $pubblicazioni[$i]['titolo'] = $pubblicazione->titolo;
                $pubblicazioni[$i]['autore'] = $autore->name;
                $i++;
            }

            $data = [
                "id_progetto"=> $id,
                "nome" => $progetto->nome,
                "descrizione" => $progetto->descrizione,
                "id_responsabile" => $progetto->id_responsabile,
                "responsabile" => $responsabile->name,
                "stato" => $progetto->stato,
                "data_inizio" => $progetto->data_inizio,
                "data_fine" => $progetto->data_fine,
                "ricercatori" => $ricercatori,
                "finanziatori" => $finanziatori,
                "budget" => $budget,
                "numeroPub"=>$pubblicazioni_number,
                "spese" => $spese,
                "pubblicazioni" => $pubblicazioni
            ];

            if(!Auth::guest()){
                if (Auth::user()->type == "Manager") {
                    $data['users'] = DB::table("users")->select(['id','name','surname'])->whereRaw("type = 'Manager' OR type = 'Ricercatore' ")->get();
                }
            }

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
                return view('pages.error')->with("title", "errore")->with("description","ERRORE DI AUTENTICAZIONE: Utente non autorizzato");
            }
        } catch (\Throwable $th) {
            return view('pages.error')->with("title", "errore")->with("description","Si è verificato un errore :-(");
        }

        return redirect()->route('project-dashboard', [$id_progetto]);   //riporto alla pagina del progetto
    }

    public function updateProject(Request $request)
    {
        try {

            $id_progetto = $request['id_progetto'];
            $progetto = Project::where('id', $id_progetto)->first();   //progetto in questione

            if(Auth::user()->type == "Manager"){                     //se è un manager a fare questa richiesta

                // modifico i dati del progetto
                $progetto->nome = $request['nome'];
                $progetto->descrizione = $request['descrizione'];
                $progetto->data_inizio = $request['inizio'];
                $progetto->data_fine = $request['fine'];
                $progetto->stato = $request['stato'];
                $progetto->id_responsabile = (int)$request['responsabile'];
                $progetto->save();                           //salvo nel db
            }
            else{                                        //se NON è il responsabile a fare questa richiesta do errore
                return view('pages.error')->with("title", "errore")->with("description","ERRORE DI AUTENTICAZIONE: Utente non autorizzato");
            }
        } catch (\Throwable $th) {
            return view('pages.error')->with("title", "errore")->with("description","Si è verificato un errore :-(");
        }

        return redirect()->route('project-dashboard', [$id_progetto]);   //riporto alla pagina del progetto
    }

    public function deleteProject(Request $request)
    {
        try {

            $id_progetto = $request['id_progetto'];
            $progetto = Project::where('id', $id_progetto)->first();   //progetto in questione

            if(Auth::user()->type == "Manager"){                     //se è un manager a fare questa richiesta

                $progetto->delete();
            }
            else{                                        //se NON è il responsabile a fare questa richiesta do errore
                return view('pages.error')->with("title", "errore")->with("description","ERRORE DI AUTENTICAZIONE: Utente non autorizzato");
            }
        } catch (\Throwable $th) {
            return view('pages.error')->with("title", "errore")->with("description","Si è verificato un errore :-(".$th->getMessage());
        }

        return redirect()->route('project-list');   //riporto alla lista dei progetti
    }

    public function deletePublicationFromProject(Request $request)
    {
        try {

            $id_progetto = $request['id_progetto'];
            $progetto = Project::where('id', $id_progetto)->first();   //progetto in questione
            $userId = Auth::user()->id;                                //id dell'utente

            if($userId == $progetto->id_responsabile){   //se è il responsabile a fare questa richiesta
                $pubblicazione = Pubblication::where('id', $request['id_pubblicazione'])->where('id_progetto', $id_progetto)->first();
                $pubblicazione->id_progetto = null;
                $pubblicazione->save();
            }
            else{                                        //se NON è il responsabile a fare questa richiesta response status 403
                return response('Utente non autorizzato', 403);
            }
        } catch (\Throwable $th) {
            return response('Si è verificato un errore', 500);
        }

        return redirect()->route('project-dashboard', [$id_progetto]);   //riporto alla pagina del progetto
    }
}
