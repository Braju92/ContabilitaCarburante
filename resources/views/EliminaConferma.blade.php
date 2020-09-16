@extends('layouts.app')

    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Enrico Testing">
    <meta name="generator" content="Test 0.0.1">
    <title>Inserimento Completato</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="form group">
        <ul class="list-group list-group-horizontal-lg">
            <div class="row">
                <div class="col">
                    <li class="list-group-item" style="color: white">
                        <h2>Carabinieri</h2>
                    </li>
                </div>
            </div>
        </ul>
    </div>
</nav>
<h1>Sei sicuro di voler eliminare la seguente riga?</h1>

<!--Tabella Rifornimento-->
@if($Tipo=='Rifornimento')
    <table class="table no-margin text-center">
        <thead>
        <tr>
            <th>Targa</th>
            <th>Litri Immessi</th>
            <th>Conduttore</th>
            <th>Data</th>
            <th>Prezzo Euro/Litro</th>
            <th>Luogo</th>
            <th>Tipo Carburante</th>
            <th>Cedole e Additivi</th>
        </tr>
        </thead>
        <tbody>


        @foreach($sel as $rifornimento)


            <tr>
                <td>{{ $rifornimento->Targa }}</td>
                <td>{{ $rifornimento->RifornimentoLitri }}</td>
                <td>{{ $rifornimento->Grado}} {{ $rifornimento->Cognome}}</td>
                <td>{{ $rifornimento->Data }}</td>
                <td>{{ $rifornimento->EuroLitro}}</td>
                <td>
                    @if( $rifornimento->Cisterna =='0')Distributore
                    @elseif( $rifornimento->Cisterna =='1')Cisterna
                    @else Sconosciuta
                    @endif
                </td>
                <td>
                    @if( $rifornimento->Alimentazione =='B')Benzina
                    @elseif( $rifornimento->Alimentazione =='G')Gasolio
                    @else Sconosciuta
                    @endif
                </td>
                <td>

                    <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse"
                                data-target="#Collapse{{$loop->index+1}}" aria-expanded="false"
                                aria-controls="collapseExample">
                            Dettagli
                        </button>
                    </p>
                    <div class="collapse" id="Collapse{{$loop->index+1}}">
                        <div class="card card-body">

                            <table style="border: hidden">
                                <td>
                                    <table style="border: hidden" class="table no-margin text-center">
                                        <thead>
                                        <tr>
                                            <th>ID Cedola</th>
                                            <th>Consumo Cedola</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach($cedole as $cedola)

                                            <tr>
                                                @if($rifornimento->IDRifornimento == $cedola->IDRifornimento)
                                                    <td>{{ $cedola->IDCedola }}</td>
                                                    <td>{{ $cedola->Consumo }}</td>
                                                @endif
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table style="border: hidden" class="table no-margin text-center">
                                        <thead>
                                        <tr>
                                            <th>Tipo Additivo</th>
                                            <th>Litri Additivo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($additivi as $additivo)

                                            <tr>
                                                @if($rifornimento->IDRifornimento == $additivo->IDRifornimento)
                                                    <td>{{ $additivo->TipoAdditivi }}</td>
                                                    <td>{{ $additivo->LitriAdditivi }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="list-group list-group-horizontal-lg">
        <div class="row">
            <div class="col">
                <li class="list-group-item">
                    <input type="hidden" name="Targa" value="{{$rifornimento->Targa}}"/>
                    <input type="hidden" name="Data" value="{{$rifornimento->Data}}"/>
                    <input type="hidden" name="Pagina" value="D"/>
                    {{@csrf_field()}}
                    <a href="deleterifornimento" class="btn btn-success">Conferma</a>
                </li>
            </div>
            <div class="col">
                <li class="list-group-item">
                    <a href="DeleteAnnullato" class="btn btn-danger">Annulla</a>
                </li>
            </div>
        </div>
    </ul>
@endif

<!--Tabella Cedole-->
@if($Tipo=='Cedole')
    <table class="table no-margin text-center">
        <thead>
        <tr>
            <th>Tipo Carburante</th>
            <th>Ente</th>
            <th>Prezzo</th>
            <th>N. Attive/N. Totali</th>
            <th>Taglio</th>
            <th>Data Acquisizione</th>
            <th>Singole Cedole</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sel as $cedola)
            <tr>
                <td>
                    @if( $cedola->Carburante =='B')Benzina
                    @elseif( $cedola->Carburante =='G')Gasolio
                    @else Sconosciuta
                    @endif
                </td>
                <td>{{ $cedola->Ente }}</td>
                <td>{{ $cedola->Prezzo }}</td>
                <td>{{ $cedola->Attive }}/{{ $cedola->Numero }}</td>
                <td>{{ $cedola->Taglio}}</td>
                <td>{{ $cedola->DataAcquisizione}}</td>
                <td>

                    <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse"
                                data-target="#Collapse{{$loop->index+1}}" aria-expanded="false"
                                aria-controls="collapseExample">
                            Dettagli
                        </button>
                    </p>
                    <div class="collapse" id="Collapse{{$loop->index+1}}">
                        <div class="card card-body">


                            <table style="border: hidden" class="table no-margin text-center">
                                <thead>
                                <tr>
                                    <th>ID Cedola</th>
                                    <th>Consumo Cedola</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($cedole as $cedolasingola)

                                    <tr>
                                        @if($cedola->IDGruppo == $cedolasingola->TipoCedola)
                                            <td>{{ $cedolasingola->IDCedola }}</td>
                                            <td>{{ $cedolasingola->ImportoRimanente }}</td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="list-group list-group-horizontal-lg">
        <div class="row">
            <div class="col">
                <li class="list-group-item">
                    <input type="hidden" name="Carburante" value="{{$cedola->Carburante}}"/>
                    <input type="hidden" name="Ente" value="{{$cedola->Ente}}"/>
                    <input type="hidden" name="Prezzo" value="{{$cedola->Prezzo}}"/>
                    <input type="hidden" name="Taglio" value="{{$cedola->Taglio}}"/>
                    <input type="hidden" name="Data" value="{{$cedola->DataAcquisizione}}"/>
                    <input type="hidden" name="Pagina" value="D"/>
                    {{@csrf_field()}}
                    <a href="deletecedole" class="btn btn-success">Conferma</a>
                </li>
            </div>
            <div class="col">
                <li class="list-group-item">
                    <a href="DeleteAnnullato" class="btn btn-danger">Annulla</a>
                </li>
            </div>
        </div>
    </ul>
@endif

<!--Tabella Cisterna-->
@if($Tipo=='Cisterna')
    <table class="table no-margin text-center">
        <thead>
        <tr>
            <th>Data</th>
            <th>Rimanenza Benzina</th>
            <th>Prelievo Benzina</th>
            <th>Immissione Benzina</th>
            <th>Rimanenza Gasolio</th>
            <th>Prelievo Gasolio</th>
            <th>Immissione Gasolio</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sel as $cisterna)
            <tr>
                <td>{{ $cisterna->Data }}</td>
                <td>{{ $cisterna->LitriBenzinaRimanenti }}</td>

                <td>@if($cisterna->LitriBenzinaConsumati == NULL) 0
                    @else {{ $cisterna->LitriBenzinaConsumati }}
                    @endif</td>
                <td>@if($cisterna->LitriBenzinaImmessi == NULL) 0
                    @else {{ $cisterna->LitriBenzinaImmessi }}
                    @endif</td>

                <td>{{ $cisterna->LitriGasolioRimanenti }}</td>

                <td>@if($cisterna->LitriGasolioConsumati == NULL) 0
                    @else {{ $cisterna->LitriGasolioConsumati }}
                    @endif</td>
                <td>@if($cisterna->LitriGasolioImmessi == NULL) 0
                    @else {{ $cisterna->LitriGasolioImmessi }}
                    @endif</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="list-group list-group-horizontal-lg">
        <div class="row">
            <div class="col">
                <li class="list-group-item">
                    <input type="hidden" name="Data" value="{{$cisterna->Data}}"/>
                    <input type="hidden" name="Pagina" value="D"/>
                    {{@csrf_field()}}
                    <a href="deletecisterna" class="btn btn-success">Conferma</a>
                </li>
            </div>
            <div class="col">
                <li class="list-group-item">
                    <a href="DeleteAnnullato" class="btn btn-danger">Annulla</a>
                </li>
            </div>
        </div>
    </ul>
@endif

<!--Tabella Additivo-->
@if($Tipo=='Additivi')
    <table class="table no-margin text-center">
        <thead>
        <tr>
            <th>Codice Additivo</th>
            <th>Tipo Additivo</th>

        </tr>
        </thead>
        <tbody>
        @foreach($sel as $additivo)
            <tr>
                <td>{{ $additivo->CodiceAdditivo }}</td>
                <td>{{ $additivo->TipoAdditivo }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="list-group list-group-horizontal-lg">
        <div class="row">
            <div class="col">
                <li class="list-group-item">
                    <input type="hidden" name="CodiceAdditivo" value="{{$additivo->CodiceAdditivo}}"/>
                    <input type="hidden" name="Pagina" value="D"/>
                    {{@csrf_field()}}
                    <a href="deleteadditivi" class="btn btn-success">Conferma</a>
                </li>
            </div>
            <div class="col">
                <li class="list-group-item">
                    <a href="DeleteAnnullato" class="btn btn-danger">Annulla</a>
                </li>
            </div>
        </div>
    </ul>
@endif

<!--Tabella Parco-->
@if($Tipo=='Parco')
    <table class="table no-margin text-center">
        <thead>
        <tr>
            <th>Targa</th>
            <th>Reparto</th>
            <th>Tipo</th>
            <th>Alimentazione</th>
            <th>Consumo 100 Km</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sel as $macchina)
            <tr>
                <td>{{ $macchina->Targa }}</td>
                <td>{{ $macchina->Reparto }}</td>
                <td>{{ $macchina->Tipo }}</td>
                <td>
                    @if( $macchina->Alimentazione =='B')Benzina
                    @elseif( $macchina->Alimentazione =='G')Gasolio
                    @else Sconosciuta
                    @endif
                </td>
                <td>{{ $macchina->Consumo100Km }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="list-group list-group-horizontal-lg">
        <div class="row">
            <div class="col">
                <li class="list-group-item">
                    <input type="hidden" name="Targa" value="{{$macchina->Targa}}"/>
                    <input type="hidden" name="Pagina" value="D"/>
                    {{@csrf_field()}}
                    <a href="deleteparco" class="btn btn-success">Conferma</a>
                </li>
            </div>
            <div class="col">
                <li class="list-group-item">
                    <a href="DeleteAnnullato" class="btn btn-danger">Annulla</a>
                </li>
            </div>
        </div>
    </ul>
@endif

<!--Tabella Dipendenti-->
@if($Tipo=='Dipendenti')
    <table class="table no-margin text-center">
        <thead>
        <tr>
            <th>CIP</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Grado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sel as $dipendente)
            <tr>
                <td>{{ $dipendente->CIP }}</td>
                <td>{{ $dipendente->Nome }}</td>
                <td>{{ $dipendente->Cognome }}</td>
                <td>{{ $dipendente->Grado }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="list-group list-group-horizontal-lg">
        <div class="row">
            <div class="col">
                <li class="list-group-item">
                    <input type="hidden" name="CIP" value="{{$dipendente->CIP}}"/>
                    <input type="hidden" name="Pagina" value="D"/>
                    {{@csrf_field()}}
                    <a href="deletedipendenti" class="btn btn-success">Conferma</a>
                </li>
            </div>
            <div class="col">
                <li class="list-group-item">
                    <a href="DeleteAnnullato" class="btn btn-danger">Annulla</a>
                </li>
            </div>
        </div>
    </ul>
@endif




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>

<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="dashboard.js"></script>
</body>
</html>
