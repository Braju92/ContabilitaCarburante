@extends('layouts.app')

<head>
    <title>Visualizza</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="form group">
        <form action="cedolequery" method="post">
            <ul class="list-group list-group-horizontal-lg">
                <div class="row">
                    <div class="col">
                        <li class="list-group-item" style="color: white">
                            <h2>Carabinieri</h2>
                        </li>
                    </div>
                    <div class="col">
                        <li class="list-group-item">
                            <select class="custom-select custom-select-lg mb-3" name="Campo">
                                <optgroup label="Campo">
                                    <option value="Carburante">Carburante</option>
                                    <option value="Ente">Ente</option>
                                    <option value="Prezzo">Prezzo</option>
                                    <option value="Numero">Numero Totali</option>
                                    <option value="Taglio">Taglio</option>
                                    <option value="DataAcquisizione">Data Acquisizione</option>
                                </optgroup>
                            </select>
                        </li>
                    </div>
                    <div class="col">
                        <li class="list-group-item">
                            <select class="custom-select custom-select-lg mb-3" name="Operatore">
                                <optgroup label="Operatore">
                                    <option value="=">=</option>
                                    <option value=">">></option>
                                    <option value="<" selected><</option>
                                    <option value=">=">>=</option>
                                    <option value="<="><=</option>
                                </optgroup>
                            </select>
                        </li>
                    </div>
                    <div class="col">
                        <li class="list-group-item">
                            <input type="text" class="form-control form-control-lg" style="border-radius: 5px" name="Target" placeholder="Search">
                        </li>
                    </div>
                    <div class="col">
                        <li class="list-group-item">
                            {{@csrf_field()}}
                            <input type="submit" style="width: 55%; height: 55%; border-radius: 5px; border-style: hidden"  value="OK">
                        </li>
                    </div>
                    <div class="col" style="visibility: hidden ">
                        <li  class="list-group-item" >
                        </li>
                    </div>
                    <div class="col" style="visibility: hidden ">
                        <li  class="list-group-item" >
                        </li>
                    </div>
                    <div class="col">
                        <li  class="list-group-item" style="float: left;" >
                            <button type="button" class="btn btn-secondary" style="width: 100%; height: 55%; border-radius: 5px; border-style: hidden">
                                <a href="/home" style="color: white"> Torna Indietro</a>
                            </button>
                        </li>
                    </div>
                </div>
            </ul>
        </form>
    </div>
</nav>

<div class="bs-example">
    <!-- lista delle tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="Parco" class="nav-link">Parco</a>
        </li>
        <li class="nav-item">
            <a href="Rifornimenti" class="nav-link">Rifornimenti</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link active">Cedole</a>
        </li>
        <li class="nav-item">
            <a href="Cisterna" class="nav-link">Cisterna</a>
        </li>
        <li class="nav-item">
            <a href="Dipendenti" class="nav-link">Dipendenti</a>
        </li>
        <li class="nav-item">
            <a href="Additivi" class="nav-link">Additivi</a>
        </li>
        <li class="nav-item">
            <a href="Consumi" class="nav-link">Consumi</a>
        </li>
    </ul>
</div>


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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="dashboard.js"></script>
</body>
