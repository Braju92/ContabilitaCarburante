<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewsController extends Controller
{
    //Visualizzazione da Home (Parco)
    function ParcoHome(Request $req)
    {
            $sel = DB::select("SELECT * FROM parco");

            return view('VisualizzaParco',compact('sel'));
    }

    //Visualizzazione Parco Macchine
    function ParcoQuery(Request $req)
    {

        $Campo = $req->input('Campo');
        $Operatore = $req->input('Operatore');
        $Target = $req->input('Target');

        if($Campo=='Alimentazione'){
            if( (strcasecmp($Target, 'Gasolio') == 0) OR
                (strcasecmp($Target, 'G') == 0) OR
                (strcasecmp($Target, 'Gas') == 0)){
                $Target = 'G';
            }
            else{
                $Target = 'B';
            }
        }

        $sel = DB::select("SELECT * FROM parco WHERE {$Campo} {$Operatore} '{$Target}' ORDER BY {$Campo}" );

        return view('VisualizzaParco',compact('sel'));
    }

    //Visualizzazione da Home (Rifornimenti)
    function RifornimentiHome(Request $req)
    {
        $sel = DB::select(  "     SELECT IDRifornimento, Targa, RifornimentoLitri, Data, EuroLitro, Cisterna, Grado, Cognome, Alimentazione
                                        FROM rifornimenti
                                        JOIN dipendenti ON conduttore=CIP
                                        NATURAL JOIN parco");
        $cedole = DB::select("SELECT * FROM utilizzocedola");
        $additivi = DB::select("SELECT * FROM additivirifornimento");

        return view('VisualizzaRifornimenti',compact('sel','cedole','additivi'));
    }


    //Visualizzazione Rifornimenti
    function RifornimentiQuery(Request $req)
    {

        $Campo = $req->input('Campo');
        $Operatore = $req->input('Operatore');
        $Target = $req->input('Target');

        if($Campo=='Cisterna'){
            if( (strcasecmp($Target, 'Cisterna') == 0) OR
                (strcasecmp($Target, 'C') == 0) OR
                (strcasecmp($Target, 'Cis') == 0)){
                $Target = '1';
            }
            else{
                $Target = '0    ';
            }
        }
        if($Campo=='Alimentazione'){
            if( (strcasecmp($Target, 'Gasolio') == 0) OR
                (strcasecmp($Target, 'G') == 0) OR
                (strcasecmp($Target, 'Gas') == 0)){
                $Target = 'G';
            }
            else{
                $Target = 'B';
            }
        }

        $sel = DB::select("       SELECT IDRifornimento, Targa, RifornimentoLitri, Data, EuroLitro, Cisterna, Grado, Cognome, Alimentazione
                                        FROM rifornimenti
                                        JOIN dipendenti ON conduttore=CIP
                                        NATURAL JOIN parco
                                        WHERE {$Campo} {$Operatore} '{$Target}' ORDER BY {$Campo} ");
        $cedole = DB::select("SELECT * FROM utilizzocedola");
        $additivi = DB::select("SELECT * FROM additivirifornimento");

        return view('VisualizzaRifornimenti',compact('sel','cedole','additivi'));
    }

    //Visualizzazione da Home (Cedole)
    function CedoleHome(Request $req)
    {
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
                                     ");

        $cedole = DB::select("SELECT * FROM cedole");


        return view('VisualizzaCedole',compact('sel','cedole'));
    }
    //Visualizzazione Cedole
    function CedoleQuery(Request $req)
    {

        $Campo = $req->input('Campo');
        $Operatore = $req->input('Operatore');
        $Target = $req->input('Target');

        if($Campo=='Carburante'){
            if( (strcasecmp($Target, 'Gasolio') == 0) OR
                (strcasecmp($Target, 'G') == 0) OR
                (strcasecmp($Target, 'Gas') == 0)){
                $Target = 'G';
            }
            else{
                $Target = 'B';
            }
        }


        $sel = DB::select("SELECT DISTINCT t1.IDGruppo, t1.Carburante, t1.Ente, t1.Prezzo, t1.Numero, t1.Taglio, t1.DataAcquisizione, t2.Attive
                                    FROM (  SELECT IDGruppo, Carburante, Ente, Prezzo, Numero, Taglio, DataAcquisizione
                                            FROM tipocedole JOIN cedole
                                            ON IDGruppo=TipoCedola
                                            WHERE {$Campo} {$Operatore} '{$Target}' ORDER BY {$Campo} )t1
                                    NATURAL JOIN
                                        (   SELECT IDGruppo, COUNT(*) AS Attive
                                            FROM tipocedole JOIN cedole
                                            ON IDGruppo=TipoCedola
                                            GROUP BY IDGruppo)t2
                                            ");

        $cedole = DB::select("SELECT * FROM cedole");

        return view('VisualizzaCedole',compact('sel','cedole'));
    }

    //Visualizzazione da Home (Cisterna)
    function CisternaHome(Request $req)
    {
        $sel = DB::select("SELECT * FROM depositocisterna");

        return view('VisualizzaCisterna',compact('sel'));
    }
    //Visualizzazione Cisterna
    function CisternaQuery(Request $req)
    {

        $Campo = $req->input('Campo');
        $Operatore = $req->input('Operatore');
        $Target = $req->input('Target');

        $sel = DB::select("SELECT * FROM depositocisterna WHERE {$Campo} {$Operatore} '{$Target}' ORDER BY {$Campo} ");

        return view('VisualizzaCisterna',compact('sel'));
    }

    //Visualizzazione da Home (Dipendenti)
    function DipendentiHome(Request $req)
    {
        $sel = DB::select("SELECT * FROM dipendenti");

        return view('VisualizzaDipendenti',compact('sel'));
    }
    //Visualizzazione Dipendenti
    function DipendentiQuery(Request $req)
    {

        $Campo = $req->input('Campo');
        $Operatore = $req->input('Operatore');
        $Target = $req->input('Target');

        $sel = DB::select("SELECT * FROM dipendenti WHERE {$Campo} {$Operatore} '{$Target}' ORDER BY {$Campo} ");

        return view('VisualizzaDipendenti',compact('sel'));
    }

    //Visualizzazione da Home (Additivi)
    function AdditiviHome(Request $req)
    {
        $sel = DB::select("SELECT * FROM listaadditivi");

        return view('VisualizzaAdditivi',compact('sel'));
    }
    //Visualizzazione Additivi
    function AdditiviQuery(Request $req)
    {

        $Campo = $req->input('Campo');
        $Operatore = $req->input('Operatore');
        $Target = $req->input('Target');

        $sel = DB::select("SELECT * FROM listaadditivi WHERE {$Campo} {$Operatore} '{$Target}' ORDER BY {$Campo} ");

        return view('VisualizzaAdditivi',compact('sel'));
    }

    //Visualizzazione da Home (Consumi)
    function ConsumiHome(Request $req)
    {
        $sel = DB::select("   SELECT now.Data, now.Targa, now.KmAttuali, Consumo100Km,
                                    (now.KmAttuali - prev.KmAttuali)/rifornimenti.RifornimentoLitri AS Difference
                                    FROM consumirifornimento AS now
                                    NATURAL JOIN parco
                                    LEFT JOIN consumirifornimento AS prev
                                    ON now.Step = prev.Step +1
                                    JOIN rifornimenti
                                    ON now.Targa = rifornimenti.targa
                                    WHERE now.Targa = prev.Targa
                                    AND rifornimenti.data = now.data
                                    ");

        return view('VisualizzaConsumi',compact('sel'));
    }
    //Visualizzazione Consumi
    function ConsumiQuery(Request $req)
    {

        $Campo = $req->input('Campo');
        $Operatore = $req->input('Operatore');
        $Target = $req->input('Target');

        $sel = DB::select("   SELECT now.Data, now.Targa, now.KmAttuali, Consumo100Km,
                                    (now.KmAttuali - prev.KmAttuali)/rifornimenti.RifornimentoLitri AS Difference
                                    FROM consumirifornimento AS now
                                    NATURAL JOIN parco
                                    LEFT JOIN consumirifornimento AS prev
                                    ON now.Step = prev.Step +1
                                    JOIN rifornimenti
                                    ON now.Targa = rifornimenti.targa
                                    WHERE now.Targa = prev.Targa
                                    AND rifornimenti.data = now.data
                                    AND  now.{$Campo} {$Operatore} '{$Target}'
                                    ORDER BY {$Campo}
                                    ");

        return view('VisualizzaConsumi',compact('sel'));;
    }
}
