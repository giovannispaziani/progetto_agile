<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class documentationController extends Controller
{
    public function index($id){
        if(Auth::user()->type == "Manager"){
            if(DB::table("projects")->where("id",$id)->exists()){
                $documents= DB::table("pubblications")
                ->join('users','pubblications.id_autore','=','users.id')
                ->join('projects','pubblications.id_progetto','=','projects.id')
                ->where("pubblications.id_progetto",$id)->get();
                $project=DB::table('projects')->where("id",$id)->pluck("nome");
                $data = [];
                $i=0;
                foreach($documents as $document){
                    $data[$i]['titolo']=$document->titolo;
                    $data[$i]['autore']=$document->surname;
                    $data[$i]['progetto']=$document->nome;
                    $data[$i]['file_path']=$document->file_path;
                    $i++;
                }
                return view('pages.documentList')->with("data",$data)->with("project",$project);
            }else{
                abort(404); 
            } 
        }else{
            abort(403);
        }
    }
}
