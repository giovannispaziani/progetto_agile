<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class modificaPartecipantiProgettoController extends Controller
{
    public function index($id_progetto){
        $id_responsabile=DB::table("projects")->where("id",$id_progetto)->pluck("id_responsabile")->first();
        if(Auth::user()->id != $id_responsabile){
            abort(403);
        }
        $ricercatori_table = DB::table("users")->orderBy('id')->where("type","Ricercatore")->get();
        $allricercatori=[];
        $cont=0;
        foreach($ricercatori_table  as $r){
            $allricercatori[$cont]['id']= $r->id;
            $allricercatori[$cont]['nome']= $r->name;
            $allricercatori[$cont]['cognome']= $r->surname;
            $cont++;
        }
        return view('pages.addRicercatore')->with('id_progetto',$id_progetto)->with('ricercatori',$allricercatori);
    }


    public function add($id_progetto,$id_ricercatore){

        $ricercatore=DB::table("users")->where("id",$id_ricercatore)->pluck("type")->first();
        $id_responsabile=DB::table("projects")->where("id",$id_progetto)->pluck("id_responsabile")->first();
        if(Auth::user()->id != $id_responsabile){
            abort(403);
        }
        if($ricercatore != "Ricercatore"){
            abort(403);
        }
        elseif(DB::table("research_groups")->where("id_progetto",$id_progetto)->exists()){
            try{
                DB::table("research_groups")->where("id_progetto",$id_progetto)
                                ->where("id_ricercatore",$id_ricercatore)->insert([
                                    'id_progetto'=> $id_progetto,
                                    'id_ricercatore'=> $id_ricercatore,
                                ]);

            }catch(\Throwable $th){
                return redirect('/project-dashboard/'.$id_progetto);
            }
           
        }
        return redirect('/project-dashboard/'.$id_progetto);
    }



    public function remove($id,$ricercatore)
    {
        $id_responsabile=DB::table("projects")->where("id",$id)->pluck("id_responsabile")->first();
        if(Auth::user()->id != $id_responsabile){
            abort(403);
        }elseif(DB::table("research_groups")->where("id_progetto",$id)->exists()){
            $a=DB::table("research_groups")->where("id_progetto",$id)
                    ->where("id_ricercatore",$ricercatore)->delete();
            return redirect('/project-dashboard/'.$id);
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }


}