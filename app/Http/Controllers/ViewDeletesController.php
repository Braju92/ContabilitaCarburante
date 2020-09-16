<?php

namespace App\Http\Controllers;

use App\Rules\AdditiviRule;
use App\Rules\CIPRule;
use App\Rules\DecimaliTreRule;
use App\Rules\TargaRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewDeletesController extends Controller
{
    function Rifornimento(Request $req)
    {
        $req->validate([
            'Targa' => ['Required', 'size:5', new TargaRule()],
            'Data' => 'required|date'
        ]);

        $Targa = $req->input('Targa');
        $Data = $req->input('DataRifornimento');
        $Tipo = 'Rifornimento';

        $sel = DB::select("       SELECT IDRifornimento, Targa, RifornimentoLitri, Data, EuroLitro, Cisterna, Grado, Cognome, Alimentazione
                                        FROM rifornimenti
                                        JOIN dipendenti ON conduttore=CIP
                                        NATURAL JOIN parco
                                        WHERE Targa = '{$Targa}'
                                        AND Data = '{$Data}'");

        $cedole = DB::select("SELECT * FROM utilizzocedola");
        $additivi = DB::select("SELECT * FROM additivirifornimento");

        return view('EliminaConferma', compact('sel', 'cedole', 'additivi','Tipo'));
    }

    function Cedole(Request $req)
    {

        $req->validate([
            'Carburante' => 'size:1',
            'Ente' => 'required|alpha_num|max:25',
            'Prezzo' => ['required', new DecimaliTreRule],
            'Taglio' => 'required|numeric',
            'Data' => 'required|date',
        ]);

        $Carburante = $req->input('Carburante');
        $Ente = $req->input('Ente');
        $Prezzo = $req->input('Prezzo');
        $Taglio = $req->input('Taglio');
        $Data = $req->input('Data');
        $Tipo = 'Cedole';

        $sel = DB::select("   SELECT DISTINCT t1.IDGruppo, t1.Carburante, t1.Ente, t1.Prezzo, t1.Numero, t1.Taglio, t1.DataAcquisizione, t2.Attive
                                    FROM (  SELECT IDGruppo, Carburante, Ente, Prezzo, Numero, Taglio, DataAcquisizione
                                            FROM tipocedole JOIN cedole
                                            ON IDGruppo=TipoCedola )t1
                                    NATURAL JOIN
                                        (   SELECT IDGruppo, COUNT(*) AS Attive
                                            FROM tipocedole JOIN cedole
                                            ON IDGruppo=TipoCedola
                                            WHERE ImportoRimanente > 0
                                            GROUP BY IDGruppo)t2
                                    WHERE Carburante = '{$Carburante}'
                                    AND Ente = '{$Ente}'
                                    AND Prezzo = '{$Prezzo}'
                                    AND Taglio = '{$Taglio}'
                                    AND DataAcquisizione = '{$Data}'
                                     ");

        $cedole = DB::select("SELECT * FROM cedole");


        return view('EliminaConferma',compact('sel','cedole','Tipo'));

    }

    function Cisterna(Request $req)
    {
        $req->validate([
            'Data' => 'required|date',

        ]);

        $Data = $req->input('Data');
        $Tipo = 'Cisterna';
        $sel = DB::select("SELECT * FROM depositocisterna WHERE `Data` = '{$Data}'");
        return view('EliminaConferma',compact('sel','Tipo'));
    }

    function Additivi(Request $req)
    {

        $req->validate([
            'CodiceAdditivo' => ['required', 'size:16', new AdditiviRule]
        ]);

        $CodiceAdditivo = $req->input('CodiceAdditivo');
        $Tipo = 'Additivi';
        $sel = DB::select("SELECT * FROM listaadditivi WHERE `CodiceAdditivo` = '{$CodiceAdditivo}'");
        return view('EliminaConferma',compact('sel','Tipo'));

    }

    function Parco(Request $req)
    {
        $req->validate([
            'Targa' => ['required', 'size:5', new TargaRule]

        ]);

        $Targa = $req->input('Targa');
        $Tipo = 'Parco';
        $sel = DB::select("SELECT * FROM parco WHERE `Targa` = '{$Targa}'");
        return view('EliminaConferma',compact('sel','Tipo'));

    }

    function Dipendenti(Request $req)
    {

        $req->validate([
            'CIP' => ['required', 'size:8', new CIPRule]
        ]);

        $CIP = $req->input('CIP');
        $Tipo = 'Dipendenti';
        $sel = DB::select("SELECT * FROM dipendenti WHERE `CIP`='{$CIP}'");
        return view('EliminaConferma',compact('sel','Tipo'));

    }
}
