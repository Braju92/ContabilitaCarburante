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
<h1>Inserimento Completato, hai inserito:</h1>

<!--Tabella Rifornimento-->
@if($Tipo=='Rifornimento')
<table class="table no-margin text-center">
    <thead>
    <tr>
        <th>Targa</th>
        <th>Litri Rifornimento</th>
        <th>CIP</th>
        <th>Costo Carburante Euro/Litro</th>
        <th>Data</th>
        <th>Kilometraggio</th>
        <th>Cisterna</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $Targa}}</td>
        <td>{{ $LitriRifornimento}}</td>
        <td>{{ $CIP}}</td>
        <td>{{ $CostoCarburanteLitro}}</td>
        <td>{{ $Data}}</td>
        <td>{{ $Kilometraggio}}</td>
        <td>{{ $Cisterna}}</td>
    </tr>
    </tbody>
</table>
<ul class="list-group list-group-horizontal-lg">
    <div class="row">
        <div class="col">
            <li class="list-group-item">
    <a href="InserimentoConfermato" class="btn btn-success">Conferma</a>
    </li>
        </div>
        <div class="col">
            <li class="list-group-item">
    <form action="deleterifornimento" method="post">
        <input type="hidden" name="Targa" value="{{$Targa}}"/>
        <input type="hidden" name="Data" value="{{$Data}}"/>
        <input type="hidden" name="Pagina" value="I"/>
        {{@csrf_field()}}
        <button type="submit" class="btn btn-danger">Annulla</button>
    </form>
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
        <th>Carburante</th>
        <th>Ente</th>
        <th>Prezzo</th>
        <th>Numero</th>
        <th>Taglio</th>
        <th>Data</th>
        <th>Da</th>
        <th>A</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $Carburante}}</td>
        <td>{{ $Ente}}</td>
        <td>{{ $Prezzo}}</td>
        <td>{{ $Numero}}</td>
        <td>{{ $Taglio}}</td>
        <td>{{ $Data}}</td>
        <td>{{ $Da}}</td>
        <td>{{ $A}}</td>
    </tr>
    </tbody>
</table>
<ul class="list-group list-group-horizontal-lg">
    <div class="row">
        <div class="col">
            <li class="list-group-item">
    <a href="InserimentoConfermato" class="btn btn-success">Conferma</a>
    </li>
        </div>
        <div class="col">
            <li class="list-group-item">
    <form action="deletecedole" method="post">
        <input type="hidden" name="Carburante" value="{{$Carburante}}"/>
        <input type="hidden" name="Ente" value="{{$Ente}}"/>
        <input type="hidden" name="Prezzo" value="{{$Prezzo}}"/>
        <input type="hidden" name="Data" value="{{$Data}}"/>
        <input type="hidden" name="Taglio" value="{{$Taglio}}"/>
        <input type="hidden" name="Pagina" value="I"/>
        {{@csrf_field()}}
        <button type="submit" class="btn btn-danger">Annulla</button>
    </form>
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
        <th>Data </th>
        <th>Litri Immessi</th>
        <th>Tipo Carburante</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $Data}}</td>
        <td>{{ $LitriImmessi}}</td>
        <td> @if($TipoCarburante=="B")Benzina
            @else Gasolio
            @endif
        </td>
    </tr>
    </tbody>
</table>
<ul class="list-group list-group-horizontal-lg">
    <div class="row">
        <div class="col">
            <li class="list-group-item">
    <a href="InserimentoConfermato" class="btn btn-success">Conferma</a>
    </li>
        </div>
        <div class="col">
            <li class="list-group-item">
    <form action="deletecisterna" method="post">
        <input type="hidden" name="Data" value="{{$Data}}"/>
        <input type="hidden" name="Pagina" value="I"/>
        {{@csrf_field()}}
        <button type="submit" class="btn btn-danger">Annulla</button>
    </form>
    </li>
        </div>
    </div>
</ul>
@endif

<!--Tabella Additivo-->
@if($Tipo=='Additivo')
<table class="table no-margin text-center">
    <thead>
    <tr>
        <th>Codice Additivo</th>
        <th>Tipo Additivo</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $CodiceAdditivo}}</td>
        <td>{{ $TipoAdditivo}}</td>
    </tr>
    </tbody>
</table>
<ul class="list-group list-group-horizontal-lg">
    <div class="row">
        <div class="col">
            <li class="list-group-item">
    <a href="InserimentoConfermato" class="btn btn-success">Conferma</a>
    </li>
        </div>
        <div class="col">
            <li class="list-group-item">
    <form action="deleteadditivi" method="post">
        <input type="hidden" name="CodiceAdditivo" value="{{$CodiceAdditivo}}"/>
        <input type="hidden" name="Pagina" value="I"/>
        {{@csrf_field()}}
        <button type="submit" class="btn btn-danger">Annulla</button>
    </form>
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
        <th>Data Acquisizione</th>
        <th>Consumo 100 Km</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $Targa }}</td>
        <td>{{ $Reparto }}</td>
        <td>{{ $Tipo }}</td>
        <td>{{ $Alimentazione }}</td>
        <td>{{ $Data }}</td>
        <td>{{ $Consumo100Km }}</td>
    </tr>
    </tbody>
</table>
<ul class="list-group list-group-horizontal-lg">
    <div class="row">
        <div class="col">
            <li class="list-group-item">
    <a href="InserimentoConfermato" class="btn btn-success">Conferma</a>
    </li>
        </div>
        <div class="col">
            <li class="list-group-item">
    <form action="deleteparco" method="post">
        <input type="hidden" name="Targa" value="{{$Targa}}"/>
        <input type="hidden" name="Pagina" value="I"/>
        {{@csrf_field()}}
        <button type="submit" class="btn btn-danger">Annulla</button>
    </form>
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
    <tr>
        <td>{{ $Nome }}</td>
        <td>{{ $Cognome }}</td>
        <td>{{ $Grado }}</td>
        <td>{{ $CIP }}</td>
    </tr>
    </tbody>
</table>
<ul class="list-group list-group-horizontal-lg">
    <div class="row">
        <div class="col">
            <li class="list-group-item">
    <a href="InserimentoConfermato" class="btn btn-success">Conferma</a>
    </li>
        </div>
        <div class="col">
            <li class="list-group-item">
    <form action="deletedipendenti" method="post">
        <input type="hidden" name="CIP" value="{{$CIP}}"/>
        <input type="hidden" name="Pagina" value="I"/>
        {{@csrf_field()}}
        <button type="submit" class="btn btn-danger">Annulla</button>
    </form>
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
