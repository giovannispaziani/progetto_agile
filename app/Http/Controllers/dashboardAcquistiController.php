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
            if(Auth::user()->id != $id_responsabile){abort(403);}
            $spese=DB::table('budgets')->where("stato",null)->where("id_progetto",$id)->get();

            $data=[];
            foreach($spese as $spesa){
                $arr=[
                    "id"=>$spesa->id,
                    "id_ricercatore"=>$spesa->id_ricercatore,
                    "scopo"=>$spesa->scopo,
                    "budget"=>$spesa->budget
                ];
                array_push($data,$arr);
            }
            return view("pages.dashboardBudget")->with("title","dashboard spese")
                        ->with("data",$data)->with("id_progetto",$id);
        }else{
            abort(403);
        }
        
    }

    public function acceptBudget(Request $request){
        $id_progetto=$request['progetto'];
        $id_budget=$request['budget'];
        $id_responsabile=DB::table("projects")->where("id",$id_progetto)->pluck("id_responsabile")->first();
        if(Auth::user()->id != $id_responsabile){
             abort(403);
        }
        if(DB::table("projects")->where("id",$id_progetto)->exists()){
           
            DB::table('budgets')->where("id",$id_budget)->update(["stato"=>1]);
            return redirect("/dashboard-budget/$id_progetto");
        }

    }

    public function refuseBudget(Request $request){
        $id_progetto=$request['progetto'];
        $id_budget=$request['budget'];
        if(DB::table("projects")->where("id",$id_progetto)->exists()){
            $id_responsabile=DB::table("projects")->where("id",$id_progetto)->pluck("id_responsabile")->first();
            if(Auth::user()->id != $id_responsabile){
                abort(403);
            }
            DB::table('budgets')->where("id",$id_budget)->update(["stato" => 0]);
            return redirect("/dashboard-budget/$id_progetto");
        }
    }
}
