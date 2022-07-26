<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Milestone;
use Illuminate\Support\Facades\Auth;

class ListaMilestoneController extends Controller
{
    public function index($id_sottoprogetto)
    {

$milestone = DB::table("milestones")->where("id_sottoprogetto",$id_sottoprogetto)->get();

$i = 0;
$lista = [];
foreach ($milestone as $evento) {

    $lista[$i]['titolo'] = $evento->titolo;
    $lista[$i]['descrizione'] = $evento->descrizione;
    $lista[$i]['data'] = $evento->data;
    $i++;

}

            $data = [

                "id_sottoprogetto" => $id_sottoprogetto,
                "lista_milestone" => $lista,
                'id_subproject' => $id_sottoprogetto

            ];

        return view('pages.milestoneList')->with("title", "Lista Milestone")->with("data",$data);

}
}
