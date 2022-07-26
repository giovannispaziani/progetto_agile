<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardProgettiRicercatoreController extends Controller
{

    public function index()
    {

        $id_ricercatore = Auth::user()->id;

        $lista_progetti = DB::table("research_groups")->where("id_ricercatore",$id_ricercatore);

        $lista_progetti_attivi = DB::table('projects')
        ->select('projects.id','projects.nome','projects.descrizione','projects.data_inizio','projects.data_fine')
        ->join('research_groups', 'research_groups.id_progetto', '=', 'projects.id')
        ->where('id_ricercatore',$id_ricercatore)->where("stato","in corso")
        ->get();

        $lista_progetti_conclusi = DB::table('projects')
        ->select('projects.id','projects.nome','projects.descrizione','projects.data_inizio','projects.data_fine')
        ->join('research_groups', 'research_groups.id_progetto', '=', 'projects.id')
        ->where('id_ricercatore',$id_ricercatore)->where("stato","concluso")
        ->get();

        $lista_progetti_eliminati = DB::table('projects')
        ->select('projects.id','projects.nome','projects.descrizione','projects.data_inizio','projects.data_fine')
        ->join('research_groups', 'research_groups.id_progetto', '=', 'projects.id')
        ->where('id_ricercatore',$id_ricercatore)->where("stato","cancellato")
        ->get();

        $i = 0;
        $progetti_attivi = [];
        foreach ($lista_progetti_attivi as $progettoattivo) {

            $progetti_attivi[$i]['id'] = $progettoattivo->id;
            $progetti_attivi[$i]['nome'] = $progettoattivo->nome;
            $progetti_attivi[$i]['descrizione'] = $progettoattivo->descrizione;
            $progetti_attivi[$i]['data_inizio'] = $progettoattivo->data_inizio;
            $progetti_attivi[$i]['data_fine'] = $progettoattivo->data_fine;
            $i++;

        }

        $i = 0;
        $progetti_conclusi = [];
        foreach ($lista_progetti_conclusi as $progettoconcluso) {

            $progetti_conclusi[$i]['id'] = $progettoattivo->id;
            $progetti_conclusi[$i]['nome'] = $progettoconcluso->nome;
            $progetti_conclusi[$i]['descrizione'] = $progettoconcluso->descrizione;
            $progetti_conclusi[$i]['data_inizio'] = $progettoconcluso->data_inizio;
            $progetti_conclusi[$i]['data_fine'] = $progettoconcluso->data_fine;
            $i++;

        }

        $i = 0;
        $progetti_eliminati = [];
        foreach ($lista_progetti_eliminati as $progettoeliminato) {

            $progetti_eliminati[$i]['id'] = $progettoattivo->id;
            $progetti_eliminati[$i]['nome'] = $progettoeliminato->nome;
            $progetti_eliminati[$i]['descrizione'] = $progettoeliminato->descrizione;
            $progetti_eliminati[$i]['data_inizio'] = $progettoeliminato->data_inizio;
            $progetti_eliminati[$i]['data_fine'] = $progettoeliminato->data_fine;
            $i++;

        }

                    $data = [

                        "id" => $id_ricercatore,
                        "progetti_attivi" => $progetti_attivi,
                        "progetti_conclusi" => $progetti_conclusi,
                        "progetti_eliminati" => $progetti_eliminati

                    ];

                    return view('pages.dashboardProgettiRicercatore')->with("title", "Bozza Dashboard Ricercatore")->with("data",$data);

                }

}
