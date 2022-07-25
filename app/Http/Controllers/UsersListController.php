<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersListController extends Controller
{

    public function index()
    {
        $users = DB::table("users")->get("*");

        $data = [];
        foreach ($users as $user) {

            $a = [
                "id" => $user->id,
                "nome" => $user->name.' '.$user->surname,
                "email" => $user->email,
                "ruolo" => $user->type
            ];

            array_push($data,$a);
        }

        
        return view('pages.usersList')->with("data",$data);
    }

}
