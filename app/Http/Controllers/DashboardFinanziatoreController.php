<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardFinanziatoreController extends Controller
{

    public function index()
    {
        if (Auth::user()->type == "Finanziatore") {

        $id_finanziatore = Auth::user()->id;

        $progetti = DB::table("finanziatore")->where("id_finanziatore", $id_finanziatore)->get();

        $data = [];

        foreach ($progetti as $progetto) {

            $a = [
           "id_progetto" => $progetto->id_progetto,
           "fondo" => $progetto->fondo,
           ];

            array_push($data, $a);
        }


                return view('pages.dashboardFinanziatore')->with("title", "Dashboard Finanziatore")->with("data",$data);
        }
    }
}
