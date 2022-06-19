<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class projectListController extends Controller
{

    public function index()
    {
        $progetti = DB::table("projects")->get("*");

        $data = [];
        foreach ($progetti as $progetto) {
                
            $responsabile = DB::table("users")->where("id",$progetto->id_responsabile)->first();

            $a = [
                "id" => $progetto->id,
                "nome" => $progetto->nome,
                "id_responsabile" => $progetto->id_responsabile,
                "nome_responsabile" => $responsabile->name." ".$responsabile->surname,
                "stato" => $progetto->stato,
                "inizio" => $progetto->data_inizio,
                "fine" => $progetto->data_fine
            ];

            array_push($data,$a);
        }

        
        return view('pages.projectList')->with("title", "Creazione Progetto")->with("data",$data);
    }
}
