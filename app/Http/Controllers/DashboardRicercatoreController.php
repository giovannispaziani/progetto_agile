<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardRicercatoreController extends Controller
{
    
    public function index()
    {
        $id_ricercatore = Auth::user()->id;

            $contributi = DB::table("research_groups")->where("id_ricercatore",$id_ricercatore)->pluck("id_progetto"); //eventuale cambio da $id_contributi a $id_progetto
            $progetto = DB::table("projects")->where("id",$contributi)->first();

                // Contributi ricercatore nei progetti interni
                $i = 0;
                $progetti = [];
                foreach ($contributi as $id_ricercatore) {
                    $progetti[$i]['nome_progetto'] = $progetto->nome;
                    $progetti[$i]['descrizione_progetto'] = $progetto->descrizione;
                    $i++;
                }

                $data = [
                    "nome_progetto" => $progetto->nome,                    
                    "descrizione_progetto" => $progetto->descrizione,
   
                ];
                
                return view('pages.dashboardRicercatore')->with("title", "Dashboard Ricercatore")->with("data",$data);
        
    }
}