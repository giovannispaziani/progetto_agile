<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pubblication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PubblicazioniController extends Controller
{
    public function index () {

        $id_ricercatore = Auth::user()->id;

        $lista_progetti = DB::table("research_groups")->where("id_ricercatore",$id_ricercatore);

        $lista_progetti_attivi = DB::table('projects')
        ->select('projects.id','projects.nome')
        ->join('research_groups', 'research_groups.id_progetto', '=', 'projects.id')
        ->where('id_ricercatore',$id_ricercatore)->where("stato","in corso")
        ->get();

        $i = 0;
        $progetti_attivi = [];
        foreach ($lista_progetti_attivi as $progettoattivo) {

            $progetti_attivi[$i]['id'] = $progettoattivo->id;
            $progetti_attivi[$i]['nome'] = $progettoattivo->nome;

            $i++;

        }

                    $data = [

                        "id" => $id_ricercatore,
                        "progetti_attivi" => $progetti_attivi,

                    ];

        return view('pages.aggiungiPubblicazione')->with("title", "Aggiungi Pubblicazione")->with("data",$data);

    }

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function aggiungiPubblicazione(Request $request) {

        
        $request->validate([
                    'file' => 'required|mimes:pdf,xlxs,xlx,docx,doc,csv,txt|max:6024',
                ]);


        $pubblications = new Pubblication();
        $pubblications->id_autore = Auth::user()->id;
        $pubblications->id_progetto = $request['id_progetto'];
        $pubblications->titolo = $request['titolo'];
        $pubblications->descrizione = $request['descrizione'];
        $pubblications->testo = $request['testo'];
        
        
        
 
        //$fileName = Str::random(25);
        //$fileName = $file->name;
        $fileName = $request->file->getClientOriginalName();
        $file_path = $fileName;
 
        $path = Storage::disk('local')->put($file_path, file_get_contents($request->file));
        $path = Storage::disk('local')->url($path);
        
        // Perform the database operation here
        $pubblications->file_path =$file_path;

        $pubblications->save();

        return view('pages.pubblicazioneSuccess')->with("message","Pubblicazione aggiunta");

    }

    public function eliminaPubblicazione($id)
    {
        
        try {

            $pubblicazione = Pubblication::where('id', $id)->first();   //pubblicazione in questione

            if(Auth::user()->id == $pubblicazione->id_autore){                     //se è l'autore a fare questa richiesta
                $pubblicazione->delete();
            }
            else{                                        //se NON è l'autore a fare questa richiesta do errore
                return response('',403);
            }
        } catch (\Throwable $th) {
            return view('pages.error')->with("title", "errore")->with("description","Si è verificato un errore :-(");
        }

        return redirect('users/'.(Auth::user()->id));   //riporto alla pagina del profilo
    }

}