<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pubblication;
use App\Models\ResearchGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class PubblicazioniController extends Controller
{
    public function index () {

        $id_ricercatore = Auth::user()->id;

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

try {
    $request->validate([
        'file' => 'required|mimes:bib,txt|max:6024',
        'titolo' =>'required',
        'descrizione' =>'required',
        'testo' =>'required',
        'id_progetto' =>'required'
    ]);

} catch (\Throwable $th) {
    return view('pages.error')->with("title", "errore")->with("description", "Il file inserito non è nel formato corretto (Formati supportati: BibTex/.bib)");
}
        
     try{
    
        if (!ResearchGroup::where('id_progetto',$request['id_progetto'])->where('id_ricercatore',Auth::user()->id)->exists()) {
            return response('',403);
        }

        $pubblications = new Pubblication();
        $pubblications->id_autore = Auth::user()->id;
        $pubblications->id_progetto = $request['id_progetto'];
        $pubblications->titolo = $request['titolo'];
        $pubblications->descrizione = $request['descrizione'];
        $pubblications->testo = $request['testo'];

        //$fileName = Str::random(25);
        //$fileName = $file->name;
        $fileName = $request->file->getClientOriginalName();
        Storage::disk('local')->put($fileName, file_get_contents($request->file));
        $pubblications->file_path = $fileName;

        $pubblications->save();

        return view('pages.pubblicazioneSuccess')->with("message", "Pubblicazione aggiunta");

    }  catch (\Throwable $th) {
        return view('pages.error')->with("title", "errore")->with("description", "Si è verificato un errore :-(");
    }
}    

    public function modificaPubblicazione(Request $request)
    {
        try {

            $request->validate([
                'file' => 'mimes:bib,txt|max:6024',
            ]);

            $pubblication = Pubblication::where('id', $request->id)->first();   //prendo la pubblicazione in questione
    
            if (Auth::user()->id != $pubblication->id_autore) {        //mi assicuro che la richiesta provenga del autore
                return response('',403);
            }

            if (!ResearchGroup::where('id_progetto',$request['pr_progetto'])->where('id_ricercatore',Auth::user()->id)->exists()) {
                return response('',403);
            }
    
            //applico le modifiche richieste
            $pubblication->id_progetto = $request['pr_progetto'];
            $pubblication->titolo = $request['titolo'];
            $pubblication->descrizione = $request['descrizione'];
            $pubblication->testo = $request['testo'];
        
            //se un nuovo file viene fornito sostituisco il file
            if (gettype($request->file) != 'NULL') {

                //salvo nuovo file
                $fileName = $request->file->getClientOriginalName();
                Storage::disk('local')->put($fileName, file_get_contents($request->file));
                $pubblication->file_path = $fileName;
            }

            $pubblication->save();
            
            return redirect('users/' . (Auth::user()->id));   //riporto alla pagina del profilo

        } catch (\Throwable $th) {
            return view('pages.error')->with("title", "errore")->with("description", "Si è verificato un errore :-(");
        }
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