<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class dashboardAcquistiController extends Controller
{

    public function getListProject(){
        $id=Auth::user()->id;
        $progetti=DB::table("projects")->where("id_responsabile",$id)->where("stato","in corso")->get();

        $data=[];
        foreach($progetti as $progetto){

            $spese=[];
            $arr=[
                "id"=>$progetto->id,
                "nome"=>$progetto->nome,
                "data_inizio"=>$progetto->data_inizio,
                "data_fine"=>$progetto->data_fine
            ];
            array_push($data,$arr);
        }  
        return view("pages.responsabileProjectList")->with("title","Progetti di cui sei il responsabile")
                    ->with("data",$data);
    }

    public function index($id){
        if(DB::table("projects")->where("id",$id)->exists()){
            $id_responsabile=DB::table("projects")->where("id",$id)->pluck("id_responsabile")->first();
            if(Auth::user()->type !="Manager" && Auth::user()->id != $id_responsabile){abort(403);}
            $spese_table=DB::table('budgets')->where("stato","in attesa")->where("id_progetto",$id)->get();
            $financial_groups = DB::table("financial_groups")->where("id_progetto",$id)->pluck("id_finanziatore");
            $passivo=DB::table("budgets")->where("id_progetto",$id)->where("stato",true)->pluck("budget")->sum();
            $budget=DB::table("finanziatore")->where("id_progetto",$id)->pluck("fondo")->sum();
            $budget=$budget-$passivo;

            $data=[];
            $spese=[];
            foreach($spese_table as $spesa){
                $arr=[
                    "id"=>$spesa->id,
                    "id_ricercatore"=>$spesa->id_ricercatore,
                    "scopo"=>$spesa->scopo,
                    "budget"=>$spesa->budget
                ];
                array_push($spese,$arr);
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
            $data=[
                "id_progetto"=>$id,
                "spese" => $spese,
                "budget" => $budget,
                "finanziatori"=>$finanziatori
            ];

            return view("pages.dashboardBudget")->with("title","dashboard spese")
                        ->with("data",$data)->with("id_progetto",$id);
        }else{      
            abort(404);
        }
        
    }

    public function storico($id){
        if(DB::table("projects")->where("id",$id)->exists()){
            $id_responsabile=DB::table("projects")->where("id",$id)->pluck("id_responsabile")->first();
            if(Auth::user()->type!="Manager" && Auth::user()->id != $id_responsabile){abort(403);}
            $spese=DB::table('budgets')->where("stato","!=","in attesa")->where("id_progetto",$id)->get();

            $data=[];
            foreach($spese as $spesa){
                $ricercatore=DB::table('users')->where("id",$spesa->id_ricercatore)->pluck("surname")->first();
                $arr=[
                    "ricercatore"=>$ricercatore,
                    "scopo"=>$spesa->scopo,
                    "budget"=>$spesa->budget,
                    "stato"=>$spesa->stato
                ];
                array_push($data,$arr);
            }
            return view("pages.storicoBudget")->with("title","Storico spese")
                        ->with("data",$data)->with("id_progetto",$id);
        }else{
            abort(404);
        }
    }

    public function acceptBudget(Request $request){
        $id_progetto=$request['progetto'];
        $id_budget=$request['budget'];
        $id_responsabile=DB::table("projects")->where("id",$id_progetto)->pluck("id_responsabile")->first();
        if(Auth::user()->type!="Manager" && Auth::user()->id != $id_responsabile){abort(403);}
        if(DB::table("projects")->where("id",$id_progetto)->exists()){
           
            DB::table('budgets')->where("id",$id_budget)->update(["stato"=>"approvato"]);
            return redirect("/dashboard-budget/$id_progetto");
        }

    }

    public function refuseBudget(Request $request){
        $id_progetto=$request['progetto'];
        $id_budget=$request['budget'];
        if(DB::table("projects")->where("id",$id_progetto)->exists()){
            $id_responsabile=DB::table("projects")->where("id",$id_progetto)->pluck("id_responsabile")->first();
            if(Auth::user()->type!="Manager" && Auth::user()->id != $id_responsabile){abort(403);}
            DB::table('budgets')->where("id",$id_budget)->update(["stato" => 'rifiutato']);
            return redirect("/dashboard-budget/$id_progetto");
        }
    }
    public function aggiungiBudget(Request $request){
        if(Auth::user()->type!="Manager" && Auth::user()->id != $id_responsabile){abort(403);}
        $id_progetto=$request['id_progetto'];
        DB::table("finanziatore")->insert(array(
            "id_progetto"=>$id_progetto,
            "id_finanziatore"=>$request['id_finanziatore'],
            "fondo"=>$request['importo']
        ));
        return redirect("/dashboard-budget/$id_progetto");
    }
}
