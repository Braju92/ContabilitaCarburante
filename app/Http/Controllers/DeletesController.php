<?php

namespace App\Http\Controllers;

use App\Rules\AdditiviRule;
use App\Rules\CIPRule;
use App\Rules\DecimaliTreRule;
use App\Rules\TargaRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeletesController extends Controller
{
    function Rifornimento(Request $req)
    {

        $req->validate([
            'Targa' => ['Required', 'size:5', new TargaRule()],
            'Data' => 'required|date'
        ]);

        $Targa = $req->input('Targa');
        $Data = $req->input('Data');
        $Pagina = $req->input('Pagina');

        $ID = DB::select("    SELECT IDRifornimento,Cisterna
                                    FROM rifornimenti
                                    WHERE Targa = '{$Targa}'
                                    AND Data = '{$Data}'");

        $Cisterna = $ID[0]->Cisterna;
        $ID = $ID[0]->IDRifornimento;

        if($Cisterna == 0) {


            DB::update("  UPDATE cedole
                                SET ImportoRimanente = ImportoRimanente + (SELECT Consumo
                                                        FROM utilizzocedola
                                                        WHERE (cedole.IDCedola = utilizzocedola.IDCedola))
                                WHERE EXISTS (  SELECT *
                                                FROM utilizzocedola
                                                WHERE (cedole.IDCedola = utilizzocedola.IDCedola));");


            DB::delete("  DELETE FROM `additivirifornimento` WHERE IDRifornimento = '{$ID}'");
            DB::delete("  DELETE FROM `utilizzocedola` WHERE IDRifornimento = '{$ID}'");

        }

        DB::delete("  DELETE FROM `consumirifornimento` WHERE Targa = '{$Targa}'");
        DB::delete("  DELETE FROM `rifornimenti` WHERE IDRifornimento = '{$ID}'");

        if($Pagina == 'D') {
            return view('DeleteConfermato');
        }
        else {
            return view('InserimentoAnnullato');
        }
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
        $Pagina = $req->input('Pagina');


        $Gruppo = DB::select(" SELECT IDGruppo
                                    FROM tipocedole
                                    WHERE Carburante = '{$Carburante}'
                                    AND Ente = '{$Ente}'
                                    AND Prezzo = '{$Prezzo}'
                                    AND Taglio = '{$Taglio}'
                                    AND DataAcquisizione = '{$Data}'");

        $Gruppo = $Gruppo[0]->IDGruppo;

        DB::delete("DELETE FROM Cedole WHERE TipoCedola = '{$Gruppo}'");

        DB::delete("DELETE FROM tipocedole WHERE IDGruppo = '{$Gruppo}'");


        if($Pagina == 'D') {
            return view('DeleteConfermato');
        }
        else {
            return view('InserimentoAnnullato');
        }

    }

    function Cisterna(Request $req)
    {

        $req->validate([
            'Data' => 'required|date',

        ]);

        $Data = $req->input('Data');
        $Pagina = $req->input('Pagina');

        $LitriBenzinaImmessi = DB::select(" SELECT LitriBenzinaImmessi
                                    FROM depositocisterna
                                    WHERE Data = '{$Data}'");
        $LitriBenzinaImmessi = $LitriBenzinaImmessi[0]->LitriBenzinaImmessi;

        $LitriGasolioImmessi = DB::select(" SELECT LitriGasolioImmessi
                                    FROM depositocisterna
                                    WHERE Data = '{$Data}'");
        $LitriGasolioImmessi = $LitriGasolioImmessi[0]->LitriGasolioImmessi;

        DB::delete("   DELETE FROM `depositocisterna` WHERE `Data` = '{$Data}' ");

        DB::update("      UPDATE `depositocisterna`
                                        SET `LitriBenzinaRimanenti`= `LitriBenzinaRimanenti`-'{{$LitriBenzinaImmessi}}',
                                            `LitriGasolioRimanenti`= `LitriGasolioRimanenti`-'{{$LitriGasolioImmessi}}',
                                        WHERE Data > '{$Data}'");

        if($Pagina == 'D') {
            return view('DeleteConfermato');
        }
        else {
            return view('InserimentoAnnullato');
        }


    }

    function Additivi(Request $req)
    {

        $req->validate([
            'CodiceAdditivo' => ['required', 'size:16', new AdditiviRule]
        ]);

        $CodiceAdditivo = $req->input('CodiceAdditivo');
        $Pagina = $req->input('Pagina');


        DB::delete("   DELETE FROM `listaadditivi` WHERE `CodiceAdditivo` = '{$CodiceAdditivo}'");

        if($Pagina == 'D') {
            return view('DeleteConfermato');
        }
        else {
            return view('InserimentoAnnullato');
        }

    }

    function Parco(Request $req)
    {

        $req->validate([
            'Targa' => ['required', 'size:5', new TargaRule]

        ]);

        $Targa = $req->input('Targa');
        $Pagina = $req->input('Pagina');


        DB::delete("   DELETE FROM `parco` WHERE `Targa` = '{$Targa}'");

        if($Pagina == 'D') {
            return view('DeleteConfermato');
        }
        else {
            return view('InserimentoAnnullato');
        }

    }

    function Dipendenti(Request $req)
    {

        $req->validate([
            'CIP' => ['required', 'size:8', new CIPRule]
        ]);

        $CIP = $req->input('CIP');
        $Pagina = $req->input('Pagina');


       DB::delete("DELETE FROM `dipendenti` WHERE `CIP`='{$CIP}'");

        if($Pagina == 'D') {
            return view('DeleteConfermato');
        }
        else {
            return view('InserimentoAnnullato');
        }
    }
}
