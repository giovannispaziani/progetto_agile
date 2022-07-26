<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ResearchGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class ReportProgettoController extends Controller
{
    public function index($id_progetto)
    {

    $report = DB::table("reports")->where("id_progetto",$id_progetto)->get();

    $i = 0;
    $lista = [];

    foreach ($report as $rep) {

        $ricercatore = DB::table("users")->where("id",$rep->id_ricercatore)->first();

    $lista[$i]['id'] = $rep->id;
    $lista[$i]['ricercatore'] = $ricercatore->name." ".$ricercatore->surname;
    $lista[$i]['id_progetto'] = $rep->id_progetto;
    $lista[$i]['titolo'] = $rep->titolo;
    $lista[$i]['descrizione'] = $rep->descrizione;
    $lista[$i]['data'] = $rep->data;
    $lista[$i]['fileName'] = $rep->file_path;
    $i++;

    }

        $data = [

                "lista_report" => $lista

        ];

        return view('pages.reportList')->with("title", "Report Progetto")->with("data",$data);

}

public function aggiuntaReport() {

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

    return view('pages.aggiungiReport')->with("title", "Aggiungi Report")->with("data",$data);

}

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function caricaReport(Request $request) {

      try {
          $request->validate([
              'file' => 'required|mimes:pdf,txt|max:6024',
              'titolo' =>'required',
              'descrizione' =>'required',
              'data' =>'required',
              'id_progetto' =>'required',
          ]);

      } catch (\Throwable $th) {
          return view('pages.error')->with("title", "errore")->with("description", "Il file inserito non è nel formato corretto (Formati supportati: .pdf , .txt)");
      }

      try {
if (!ResearchGroup::where('id_progetto',$request['id_progetto'])->where('id_ricercatore',Auth::user()->id)->exists()) {
            return response('',403);
        }

        $reports = new Report();
        $reports->id_ricercatore = Auth::user()->id;
        $reports->id_progetto = $request['id_progetto'];
        $reports->titolo = $request['titolo'];
        $reports->descrizione = $request['descrizione'];
        $reports->data = $request['data'];

        $fileName = $request->file->getClientOriginalName();
        Storage::disk('local')->put($fileName, file_get_contents($request->file));
        $reports->file_path = $fileName;

        $reports->save();

        return redirect()->route('reportList', [$request['id_progetto']]);
    } catch (\Throwable $th) {
        return view('pages.error')->with("title", "errore")->with("description", "Si è verificato un errore :-(");
    }
    }

    public function download(Request $request, $fileName) {

        $path = storage_path('app/' . $fileName);
        if (file_exists($path)) {
            return response(
                file_get_contents($path),
                200,
                [
                    'Content-Type' => 'application/octet-stream',
                    "Content-disposition" => "attachment; filename=\"".$fileName. "\""
                ]
            );
        }
        else{
            return view('pages.error')->with("title", "Errore")->with("description", "File mancante");
        }

    }

}
