@extends('layouts.app')

<head>
    <title>Visualizza</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
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
                <div class="col">
                    <li class="list-group-item" style="float: left;">
                        <button type="button" class="btn btn-secondary"
                                style="width: 100%; height: 55%; border-radius: 5px; border-style: hidden">
                            <a href="/home" style="color: white"> Torna Indietro</a>
                        </button>
                    </li>
                </div>
            </div>
        </ul>
    </div>
</nav>


<div class="bs-example">
    <!-- lista delle tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="Visualizza/Parco" class="nav-link">Parco</a>
        </li>
        <li class="nav-item">
            <a href="Visualizza/Rifornimenti" class="nav-link">Rifornimenti</a>
        </li>
        <li class="nav-item">
            <a href="Visualizza/Cedole" class="nav-link">Cedole</a>
        </li>
        <li class="nav-item">
            <a href="Visualizza/Cisterna" class="nav-link">Cisterna</a>
        </li>
        <li class="nav-item">
            <a href="Visualizza/Dipendenti" class="nav-link">Dipendenti</a>
        </li>
        <li class="nav-item">
            <a href="Visualizza/Additivi" class="nav-link">Additivi</a>
        </li>
        <li class="nav-item">
            <a href="Visualizza/Consumi" class="nav-link">Consumi</a>
        </li>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="dashboard.js"></script>
</body>
