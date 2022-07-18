<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subprojects;
use Illuminate\Support\Facades\Auth;

class ListaSottoProgettiController extends Controller
{
    public function index($id_progetto)
    {

$sottoprogetti = DB::table("subprojects")->where("id_progetto",$id_progetto)->get();

$i = 0;
$lista = [];
foreach ($sottoprogetti as $sottoprogetto) {

    $responsabile = DB::table("users")->where("id",$sottoprogetto->id_responsabile)->first();

    $lista[$i]['id'] = $sottoprogetto->id;
    $lista[$i]['titolo'] = $sottoprogetto->titolo;
    $lista[$i]['descrizione'] = $sottoprogetto->descrizione;
    $lista[$i]['termine'] = $sottoprogetto->data_fine;
    $lista[$i]['responsabile'] = $sottoprogetto->id_responsabile;
    $lista[$i]['nome_responsabile'] = $responsabile->name." ".$responsabile->surname;
    $i++;

}

            $data = [

                "id_progetto" => $id_progetto,
                "lista_sottoprogetti" => $lista

            ];

        return view('pages.sottoProgettiList')->with("title", "Lista Sottoprogetti")->with("data",$data);

}

}
