@extends('layouts.app')

<head>
    <title>Visualizza</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="form group">
        <form action="rifornimentiquery" method="post">
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
                                    <option value="CIP">CIP</option>
                                    <option value="Nome">Nome</option>
                                    <option value="Cognome">Cognome</option>
                                    <option value="Grado">Grado</option>
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
            <a href="Cedole" class="nav-link">Cedole</a>
        </li>
        <li class="nav-item">
            <a href="Cisterna" class="nav-link">Cisterna</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link active">Dipendenti</a>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="dashboard.js"></script>
</body>

