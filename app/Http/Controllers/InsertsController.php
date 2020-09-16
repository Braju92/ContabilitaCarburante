<?php

namespace App\Http\Controllers;

use App\Rules\AdditiviRule;
use App\Rules\CIPRule;
use App\Rules\DecimaliTreRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Rules\TargaRule;

class InsertsController extends Controller
{
    function Rifornimento(Request $req)
    {


        $req->validate([
            'Targa' => ['Required', 'size:5', new TargaRule()],
            'LitriRifornimento' => 'required|numeric',
            'CIPConduttore' => ['required', 'size:8', new CIPRule],
            'CostoCarburanteLitro' => ['required', new DecimaliTreRule],
            'DataRifornimento' => 'required|date',
            'Kilometraggio' => 'required|integer',
            'Cisterna' => 'required|boolean'
        ]);


        $Targa = $req->input('Targa');
        $LitriRifornimento = $req->input('LitriRifornimento');
        $CIP = $req->input('CIPConduttore');
        $CostoCarburanteLitro = $req->input('CostoCarburanteLitro');
        $Data = $req->input('DataRifornimento');
        $Kilometraggio = $req->input('Kilometraggio');
        $Cisterna = $req->input('Cisterna');
        $Tipo = 'Rifornimento';

        if ($Cisterna == 0) {

            $i = 0;

            do {
                $i++;
                $TempTipo = 'TipoAdditivi' . $i;
                $TipoAdditivi[$i] = $req->input($TempTipo);
                $TempLitri = 'LitriAdditivi' . $i;
                $LitriAdditivi[$i] = $req->input($TempLitri);
            } while ($TipoAdditivi[$i] != "");
            $i--;


            $j = 0;

            do {
                $j++;
                $TempID = 'IDCedola' . $j;
                $IDCedola[$j] = $req->input($TempID);
                $TempConsumo = 'ConsumoCedola' . $j;
                $ConsumoCedola[$j] = $req->input($TempConsumo);
            } while ($IDCedola[$j] != "");
            $j--;

        }


        $ID = DB::select(" SELECT MAX(IDRifornimento) AS MaxRif
                                    FROM rifornimenti");

        $ID = $ID[0]->MaxRif;
        $ID = $ID + 1;


        $Step = DB::select(" SELECT MAX(Step) AS MaxStep
                                 FROM consumirifornimento
                                 WHERE Targa = '{$Targa}'");
        $Step = $Step[0]->MaxStep;
        $Step = $Step + 1;

        DB::insert("  INSERT INTO `rifornimenti`(`IDRifornimento`, `Targa`, `RifornimentoLitri`, `Conduttore`, `Data`, `EuroLitro`, `Cisterna`)
                            VALUES ('{$ID}','{$Targa}','{$LitriRifornimento}','{$CIP}','{$Data}','{$CostoCarburanteLitro}','{$Cisterna}')");

        DB::insert("  INSERT INTO `consumirifornimento`(`Data`, `Targa`, `KmAttuali`, `Step`)
                            VALUES ('{$Data}','{$Targa}','{$Kilometraggio}','{$Step}')");

        if ($Cisterna == 0) {
            /*Ciclo Additivi*/
            for ($k = 1; $k <= $i; $k++) {

                DB::insert("  INSERT INTO `additivirifornimento`(`IDRifornimento`, `TipoAdditivi`, `LitriAdditivi`)
                                        VALUES ('{$ID}','{$TipoAdditivi[$k]}','{$LitriAdditivi[$k]}')");

            }

            /*Ciclo Cedole*/
            for ($m = 1; $m <= $j; $m++) {
                DB::insert("  INSERT INTO `utilizzocedola`(`IDRifornimento`, `IDCedola`, `Consumo`)
                                        VALUES ('{$ID}','{$IDCedola[$m]}','{$ConsumoCedola[$m]}')");

                $ImportoRimanente = DB::select(" SELECT ImportoRimanente
                                 FROM cedole
                                 WHERE IDCedola = '{$IDCedola[$m]}'");
                $ImportoRimanente = $ImportoRimanente[0]->ImportoRimanente;
                $Differenza = $ImportoRimanente - $ConsumoCedola[$m];

                DB::update("  UPDATE `cedole` SET `ImportoRimanente`= '{$Differenza}' WHERE IDCedola = '{$IDCedola[$m]}'");


            }
        }

        if ($Cisterna == 1) {
            $Alimentazione = DB::select(" SELECT Alimentazione
                                                FROM parco
                                                WHERE Targa = '{$Targa}'");
            $Presente = DB::select("  SELECT COUNT(*) as Presente
                                            FROM depositocisterna
                                            WHERE Data = '{$Data}'");

            if ($Presente[0]->Presente == 0) {


                $LitriBenzinaRimanenti = DB::select(" SELECT LitriBenzinaRimanenti
                                    FROM depositocisterna
                                    WHERE Data < '{$Data}'
                                    ORDER BY Data DESC
                                    LIMIT 1");

                $LitriGasolioRimanenti = DB::select(" SELECT LitriGasolioRimanenti
                                    FROM depositocisterna
                                    WHERE Data < '{$Data}'
                                    ORDER BY Data DESC
                                    LIMIT 1");

                if ($LitriBenzinaRimanenti == NULL) {
                    $LitriBenzinaRimanenti = 0;
                } else {

                    $LitriBenzinaRimanenti = $LitriBenzinaRimanenti[0]->LitriBenzinaRimanenti;

                }

                if ($LitriGasolioRimanenti == NULL) {
                    $LitriGasolioRimanenti = 0;
                } else {

                    $LitriGasolioRimanenti = $LitriGasolioRimanenti[0]->LitriGasolioRimanenti;

                }

                if ($Alimentazione[0]->Alimentazione == 'B') {

                    $LitriBenzinaRimanenti = $LitriBenzinaRimanenti - $LitriRifornimento;
                    DB::insert("   INSERT INTO `depositocisterna`(`Data`, `LitriBenzinaRimanenti`, `LitriBenzinaConsumati`,`LitriGasolioRimanenti`)
                                    VALUES ('{$Data}','{$LitriBenzinaRimanenti}','{$LitriRifornimento}','{$LitriGasolioRimanenti}')");


                } else {

                    $LitriGasolioRimanenti = $LitriGasolioRimanenti - $LitriRifornimento;
                    DB::insert("   INSERT INTO `depositocisterna`(`Data`, `LitriGasolioRimanenti`, `LitriGasolioConsumati`,`LitriBenzinaRimanenti`)
                                    VALUES ('{$Data}','{$LitriGasolioRimanenti}','{$LitriRifornimento}','{$LitriBenzinaRimanenti}')");


                }
            } else {
                if ($Alimentazione[0]->Alimentazione == 'B') {

                    DB::update("      UPDATE `depositocisterna`
                                        SET `LitriBenzinaRimanenti`= `LitriBenzinaRimanenti`-'{$LitriRifornimento}',
                                            `LitriBenzinaConsumati`= '{$LitriRifornimento}',
                                        WHERE Data = '{$Data}'");


                } else {

                    DB::update("      UPDATE `depositocisterna`
                                        SET `LitriGasolioRimanenti`= `LitriGasolioRimanenti`-'{$LitriRifornimento}',
                                            `LitriGasolioConsumati`= '{$LitriRifornimento}',
                                        WHERE Data = '{$Data}'");
                }
            }
        }

        return view('InserimentoSuccesso', compact('Targa', 'LitriRifornimento', 'CIP', 'CostoCarburanteLitro', 'Data', 'Kilometraggio', 'Cisterna', 'Tipo'));

    }

    function Cedole(Request $req)
    {
        $req->validate([
            'Carburante' => 'in:B,G',
            'Ente' => 'required|alpha_num|max:25',
            'Prezzo' => ['required', new DecimaliTreRule],
            'Taglio' => 'required|numeric',
            'Numero' => 'required|integer',
            'Data' => 'required|date',
            'Da' => 'required|integer',
            'A' => 'required|integer'
        ]);


        $Carburante = $req->input('Carburante');
        $Ente = $req->input('Ente');
        $Prezzo = $req->input('Prezzo');
        $Taglio = $req->input('Taglio');
        $Numero = $req->input('Numero');
        $Data = $req->input('Data');
        $Da = $req->input('Da');
        $A = $req->input('A');
        $Tipo = 'Cedole';


        if (abs($Numero) != $A - $Da + 1) {
            return Redirect::back()->withErrors(['Numero', 'Numero e Da-A non matchano']);
        }

        $Gruppo = DB::select(" SELECT MAX(IDGruppo) AS MaxID
                                    FROM tipocedole");

        $Gruppo = $Gruppo[0]->MaxID;
        $Gruppo = $Gruppo + 1;


        DB::insert("  INSERT INTO `tipocedole`(`IDGruppo`, `Carburante`, `Ente`, `Prezzo`, `Numero`, `Taglio`, `DataAcquisizione`)
                            VALUES ('{$Gruppo}','{$Carburante}','{$Ente}','{$Prezzo}','{$Numero}','{$Taglio}','{$Data}')");


        $i = (int)$Da;
        $A = (int)$A;

        while ($i <= $A) {


            DB::insert("  INSERT INTO `cedole`(`IDCedola`, `TipoCedola`, `ImportoRimanente`)
                                VALUES ('{$i}','{$Gruppo}','{$Taglio}')");
            $i++;

        }

        return view('InserimentoSuccesso', compact('Carburante', 'Ente', 'Prezzo', 'Numero', 'Taglio', 'Data', 'Da', 'A', 'Tipo'));


    }

    function Cisterna(Request $req)
    {
        $req->validate([
            'Data' => 'required|date',
            'LitriImmessi' => 'required|integer',
            'Alimentazione' => 'in:B,G'
        ]);

        $Data = $req->input('Data');
        $LitriImmessi = $req->input('LitriImmessi');
        $TipoCarburante = $req->input('Alimentazione');
        $Tipo = 'Cisterna';

        $Presente = DB::select(" SELECT Data
                                    FROM depositocisterna
                                    WHERE Data = '{$Data}'");


        if ($Presente != NULL) {


            $LitriBenzinaRimanenti = DB::select(" SELECT LitriBenzinaRimanenti
                                    FROM depositocisterna
                                    WHERE Data = '{$Data}'");
            $LitriBenzinaRimanenti = $LitriBenzinaRimanenti[0]->LitriBenzinaRimanenti;

            $LitriGasolioRimanenti = DB::select(" SELECT LitriGasolioRimanenti
                                    FROM depositocisterna
                                    WHERE Data = '{$Data}'");
            $LitriGasolioRimanenti = $LitriGasolioRimanenti[0]->LitriGasolioRimanenti;

            $LitriBenzinaImmessi = DB::select(" SELECT LitriBenzinaImmessi
                                    FROM depositocisterna
                                    WHERE Data = '{$Data}'");
            $LitriBenzinaImmessi = $LitriBenzinaImmessi[0]->LitriBenzinaImmessi;

            $LitriGasolioImmessi = DB::select(" SELECT LitriGasolioImmessi
                                    FROM depositocisterna
                                    WHERE Data = '{$Data}'");
            $LitriGasolioImmessi = $LitriGasolioImmessi[0]->LitriGasolioImmessi;


            if ($TipoCarburante == "B") {

                $LitriBenzinaImmessi = $LitriBenzinaImmessi + $LitriImmessi;
                $LitriBenzinaRimanenti = $LitriBenzinaRimanenti + $LitriImmessi;
                DB::update("      UPDATE `depositocisterna`
                                        SET `LitriBenzinaRimanenti`='{$LitriBenzinaRimanenti}',
                                            `LitriBenzinaImmessi`='{$LitriBenzinaImmessi}',
                                            `LitriGasolioRimanenti`='{$LitriGasolioRimanenti}',
                                            `LitriGasolioImmessi`='{$LitriGasolioImmessi}'
                                        WHERE Data = '{$Data}'");

            } else {

                $LitriGasolioImmessi = $LitriGasolioImmessi + $LitriImmessi;
                $LitriGasolioRimanenti = $LitriGasolioRimanenti + $LitriImmessi;
                DB::update("      UPDATE `depositocisterna`
                                        SET `LitriBenzinaRimanenti`='{$LitriBenzinaRimanenti}',
                                            `LitriBenzinaImmessi`='{$LitriBenzinaImmessi}',
                                            `LitriGasolioRimanenti`='{$LitriGasolioRimanenti}',
                                            `LitriGasolioImmessi`='{$LitriGasolioImmessi}'
                                        WHERE Data = '{$Data}'");
            }

        } else {


            $LitriBenzinaRimanenti = DB::select(" SELECT LitriBenzinaRimanenti
                                    FROM depositocisterna
                                    WHERE Data < '{$Data}'
                                    ORDER BY Data DESC
                                    LIMIT 1");

            if ($LitriBenzinaRimanenti == NULL) {
                $LitriBenzinaRimanenti = 0;
            } else {

                $LitriBenzinaRimanenti = $LitriBenzinaRimanenti[0]->LitriBenzinaRimanenti;

            }

            $LitriGasolioRimanenti = DB::select(" SELECT LitriGasolioRimanenti
                                    FROM depositocisterna
                                    WHERE Data < '{$Data}'
                                    ORDER BY Data DESC
                                    LIMIT 1");

            if ($LitriGasolioRimanenti == NULL) {
                $LitriGasolioRimanenti = 0;
            } else {

                $LitriGasolioRimanenti = $LitriGasolioRimanenti[0]->LitriGasolioRimanenti;

            }


            if ($TipoCarburante == "B") {

                $LitriBenzinaRimanenti = $LitriBenzinaRimanenti + $LitriImmessi;
                DB::insert("   INSERT INTO `depositocisterna`(`Data`, `LitriBenzinaRimanenti`, `LitriBenzinaImmessi`,`LitriGasolioRimanenti`)
                                    VALUES ('{$Data}','{$LitriBenzinaRimanenti}','{$LitriImmessi}','{$LitriGasolioRimanenti}')");

            } else {

                $LitriGasolioRimanenti = $LitriGasolioRimanenti + $LitriImmessi;
                DB::insert("   INSERT INTO `depositocisterna`(`Data`, `LitriGasolioRimanenti`, `LitriGasolioImmessi`,`LitriBenzinaRimanenti`)
                                    VALUES ('{$Data}','{$LitriGasolioRimanenti}','{$LitriImmessi}','{$LitriBenzinaRimanenti}')");

            }

        }


        if ($TipoCarburante == "B") {

            ;
            DB::update("      UPDATE `depositocisterna`
                                        SET `LitriBenzinaRimanenti`= `LitriBenzinaRimanenti`+'{$LitriImmessi}'
                                        WHERE Data > '{$Data}'");


        } else {

            DB::update("      UPDATE `depositocisterna`
                                        SET `LitriGasolioRimanenti`= `LitriGasolioRimanenti`+'{$LitriImmessi}'
                                        WHERE Data > '{$Data}'");
        }


        return view('InserimentoSuccesso', compact('Data', 'LitriImmessi', 'TipoCarburante', 'Tipo'));


    }

    function Additivi(Request $req)
    {

        $req->validate([
            'CodiceAdditivo' => ['required', 'size:16', new AdditiviRule],
            'TipoAdditivo' => 'required|max:20',
        ]);

        $CodiceAdditivo = $req->input('CodiceAdditivo');
        $TipoAdditivo = $req->input('TipoAdditivo');
        $Tipo = 'Additivo';

        DB::insert("   INSERT INTO `listaadditivi`(`CodiceAdditivo`, `TipoAdditivo`)
                                    VALUES ('{$CodiceAdditivo}','{$TipoAdditivo}')");

        return view('InserimentoSuccesso', compact('CodiceAdditivo', 'TipoAdditivo', 'Tipo'));

    }

    function Parco(Request $req)
    {

        $req->validate([
            'Targa' => ['required', 'size:5', new TargaRule],
            'Reparto' => 'required|max:50',
            'Modello' => 'required|max:25',
            'Alimentazione' => 'in:B,G',
            'Consumo100Km' => ['required', 'numeric', new DecimaliTreRule],
            'Data' => 'required|date'

        ]);

        $Targa = $req->input('Targa');
        $Reparto = $req->input('Reparto');
        $Modello = $req->input('Modello');
        $Alimentazione = $req->input('Alimentazione');
        $Consumo100Km = $req->input('Consumo100Km');
        $Data = $req->input('Data');
        $Tipo = 'Parco';

        DB::insert("   INSERT INTO `parco`(`Targa`, `Reparto`, `Tipo`, `Alimentazione`, `Consumo100Km`)
                                    VALUES ('{$Targa}','{$Reparto}','{$Modello}','{$Alimentazione}','{$Consumo100Km}')");

        DB::insert("INSERT INTO consumirifornimento(Data, Targa, KmAttuali, Step)
                                  VALUES ('{$Data}','{$Targa}','0','0')");

        return view('InserimentoSuccesso', compact('Targa', 'Reparto', 'Modello', 'Alimentazione', 'Consumo100Km','Data', 'Tipo'));

    }

    function Dipendenti(Request $req)
    {

        $req->validate([
            'Nome' => 'required|alpha|max:25',
            'Cognome' => 'required|alpha|max:25',
            'Grado' => 'required|alpha|size:3',
            'CIP' => ['required', 'size:8', new CIPRule]
        ]);

        $Nome = $req->input('Nome');
        $Cognome = $req->input('Cognome');
        $Grado = $req->input('Grado');
        $CIP = $req->input('CIP');
        $Tipo = 'Dipendenti';

        DB::insert("   INSERT INTO `dipendenti`(`CIP`, `Nome`, `Cognome`, `Grado`)
                                    VALUES ('{$CIP}','{$Nome}','{$Cognome}','{$Grado}')");

        return view('InserimentoSuccesso', compact('Nome', 'Cognome', 'Grado', 'CIP', 'Tipo'));
    }
}
