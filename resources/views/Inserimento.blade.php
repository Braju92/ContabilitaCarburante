@extends('layouts.app')

    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Enrico Testing">
    <meta name="generator" content="Test 0.0.1">
    <title>Inserimento</title>

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


    <!--Script delle cedole/cisterna-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("select").change(function () {
                $(this).find("option:selected").each(function () {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();
        });
    </script>

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


<!-- ERRORI -->
@if($errors->any())
    <div>
        <li style="color: red; font-size: large">Inserimento non riuscito. Per ulteriori dettagli ritornare sulla tab
            corretta
        </li>
    </div>
@endif


<!-- box con tab e contenuti -->
<div class="bs-example">
    <!-- lista delle tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#rifornimento" class="nav-link active" data-toggle="tab">Rifornimento</a>
        </li>
        <li class="nav-item">
            <a href="#cedola" class="nav-link" data-toggle="tab">Cedola</a>
        </li>
        <li class="nav-item">
            <a href="#cisterna" class="nav-link" data-toggle="tab">Cisterna</a>
        </li>
        <li class="nav-item">
            <a href="#additivo" class="nav-link" data-toggle="tab">Additivo</a>
        </li>
        <li class="nav-item">
            <a href="#veicolo" class="nav-link" data-toggle="tab">Veicolo</a>
        </li>
        <li class="nav-item">
            <a href="#dipendente" class="nav-link" data-toggle="tab">Dipendente</a>
        </li>
    </ul>
    <!-- contenuti tabs con id -->
    <div class="tab-content">
        <!-- Tab dei Rifornimenti -->
        <div class="tab-pane fade show active" id="rifornimento">
            <div class="container-fluid">
                <h4 class="mt-2">Inserimento dati rifornimento</h4>
                <form action="insertrifornimento" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Targa</label>
                        @error('Targa')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="Targa" id="Targa" placeholder="Targa">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Litri Rifornimento</label>
                        @error('LitriRifornimento')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="LitriRifornimento" id="LitriRifornimento"
                               placeholder="Litri immessi">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">CIP Conduttore</label>
                        @error('CIPConduttore')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="CIPConduttore" id="CIPConduttore"
                               placeholder="Codice Identificativo Conduttore">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Euro/Litro</label>
                        @error('CostoCarburanteLitro')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="CostoCarburanteLitro" id="CostoCarburanteLitro"
                               placeholder="Costo Carburante al Litro">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Data Rifornimento</label>
                        @error('DataRifornimento')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="DataRifornimento" id="DataRifornimento"
                               placeholder="YYYY-MM-DD">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Kilometri Attuali</label>
                        @error('Kilometraggio')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="Kilometraggio" id="Kilometraggio"
                               placeholder="Km">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Metodo di Rifornimento</label>
                        @error('Cisterna')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <select class="custom-select custom-select" name="Cisterna">
                            <option selected>Cisterna/Distributore</option>
                            <option value="1">Cisterna</option>
                            <option value="0">Distributore</option>
                        </select>
                    </div>
                    <div class="0 box">
                        <!-- Aggiunta dinamica degli additivi -->
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Additivi (opzionali)</label>
                            @error('TipoAdditivi')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                            @error('LitriAdditivi')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                            <div class="table-responsive">
                                <table class="table" id="dynamic_field">
                                    <tr>
                                        <td><input type="text" name="TipoAdditivi1" placeholder="Additivo"
                                                   class="form-control name_list"/></td>
                                        <td><input type="text" name="LitriAdditivi1" placeholder="Litri Additivo"
                                                   class="form-control name_list"/></td>
                                        <td>
                                            <button type="button" name="add" id="add" class="btn btn-success">Aggiungi
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                var i = 1;
                                $('#add').click(function () {
                                    i++;
                                    $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="TipoAdditivi' + i + '" placeholder="Additivo" class="form-control name_list" /></td><td><input type="text" name="LitriAdditivi' + i + '" placeholder="Litri Additivo" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
                                });
                                $(document).on('click', '.btn_remove', function () {
                                    var button_id = $(this).attr("id");
                                    $('#row' + button_id + '').remove();
                                });

                            });
                        </script>
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Cedole (opzionali)</label>
                            @error('IDCedola')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                            @error('ConsumoCedola')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                            <div class="table-responsive">
                                <table class="table" id="dynamic_field2">
                                    <tr>
                                        <td><input type="text" name="IDCedola1" placeholder="Cedola"
                                                   class="form-control name_list"/></td>
                                        <td><input type="text" name="ConsumoCedola1" placeholder="Consumo Cedola"
                                                   class="form-control name_list"/></td>
                                        <td>
                                            <button type="button" name="add2" id="add2" class="btn btn-success">Aggiungi
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                var j = 1;
                                $('#add2').click(function () {
                                    j++;
                                    $('#dynamic_field2').append('<tr id="row' + j + '"><td><input type="text" name="IDCedola' + j + '" placeholder="Cedola" class="form-control name_list" /></td><td><input type="text" name="ConsumoCedola' + j + '" placeholder="Consumo Cedola" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + j + '" class="btn btn-danger btn_remove">X</button></td></tr>');
                                });
                                $(document).on('click', '.btn_remove', function () {
                                    var button_id = $(this).attr("id");
                                    $('#row' + button_id + '').remove();
                                });
                            });
                        </script>
                        {{@csrf_field()}}
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Tab delle Cedole -->

        <div class="tab-pane fade" id="cedola">
            <div class="container-fluid">
                <h4 class="mt-2">Inserimento dati cedole</h4>
                <form action="insertcedole" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Carburante</label>
                        @error('Carburante')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <select class="custom-select custom-select" name="Carburante">
                            <option selected>Tipo carburante</option>
                            <option value="B">Benzina</option>
                            <option value="G">Gasolio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Ente</label>
                        @error('Ente')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="Ente" id="Ente" placeholder="Ente">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Prezzo</label>
                        @error('Prezzo')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="Prezzo" id="Euro" placeholder="€">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Taglio</label>
                        @error('Taglio')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="Taglio" id="Taglio" placeholder="Taglio">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Numero</label>
                        @error('Numero')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="Numero" id="Numero" placeholder="####">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Data acquisto</label>
                        @error('Data')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" class="form-control" name="Data" id="DataCedole" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Range Cedole</label>
                        @error('Numero')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <table class="table" id="dynamic_field">
                            <tr>

                                <td>
                                    @error('Da')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                    <input type="text" name="Da" placeholder="Da" class="form-control name_list"/></td>
                                <td>
                                    @error('A')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                    <input type="text" name="A" placeholder="A" class="form-control name_list"/></td>
                            </tr>
                        </table>
                    </div>
                    {{@csrf_field()}}
                    <div>
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tab della Cisterna -->
        <div class="tab-pane fade" id="cisterna">
            <div class="container-fluid">
                <h4 class="mt-2">Inserimento dati cisterna</h4>
                <form action="insertcisterna" method="post">
                    <label for="exampleFormControlInput1">Tipo Carburante</label>
                    @error('Alimentazione')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                    <select name="Alimentazione" class="custom-select custom-select">
                        <option selected>Tipo carburante</option>
                        <option value="B">Benzina</option>
                        <option value="G">Gasolio</option>
                    </select>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Litri Immessi</label>
                        @error('LitriImmessi')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="LitriImmessi" class="form-control" id="LitriImmessi"
                               placeholder="Litri immessi">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Data</label>
                        @error('Data')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="Data" class="form-control" id="DataCisterna" placeholder="YYYY-MM-DD">
                    </div>
                    {{@csrf_field()}}
                    <div>
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tab degli additivi -->
        <div class="tab-pane fade" id="additivo">
            <div class="container-fluid">
                <h4 class="mt-2">Inserimento dati additivi</h4>
                <form action="insertadditivi" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Codice Additivo</label>
                        @error('CodiceAdditivo')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="CodiceAdditivo" class="form-control" id="CodiceAdditivo"
                               placeholder="Codice Additivo">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tipo Additivo</label>
                        @error('TipoAdditivo')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="TipoAdditivo" class="form-control" id="TipoAdditivo"
                               placeholder="Tipo Additivo">
                    </div>
                    {{@csrf_field()}}
                    <div>
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tab delle Autovetture -->
        <div class="tab-pane fade" id="veicolo">
            <div class="container-fluid">
                <h4 class="mt-2">Inserimento dati veicolo</h4>
                <form action="insertparco" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Targa</label>
                        @error('Targa')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="Targa" class="form-control" id="TargaParco" placeholder="Targa">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Reparto</label>
                        @error('Reparto')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="Reparto" class="form-control" id="Reparto" placeholder="Reparto">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Modello</label>
                        @error('Modello')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="Modello" class="form-control" id="Modello"
                               placeholder="Modello Autovettura">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Alimentazione</label>
                        @error('Alimentazione')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <select name="Alimentazione" class="custom-select custom-select">
                            <option selected>Tipo carburante</option>
                            <option value="B">Benzina</option>
                            <option value="G">Gasolio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Data Acquisizione</label>
                        @error('Data')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="Data" class="form-control" id="Data"
                               placeholder="YYYY-MM-DD">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Consumo medio per 100Km</label>
                        @error('Consumo100Km')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="Consumo100Km" class="form-control" id="Litri100Km"
                               placeholder="L/100Km">
                    </div>
                    {{@csrf_field()}}
                    <div>
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tab dei Dipendenti -->
        <div class="tab-pane fade" id="dipendente">
            <div class="container-fluid">
                <h4 class="mt-2">Inserimento dati dipendente</h4>
                <form action="insertdipendenti" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nome</label>
                        @error('Nome')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name=Nome class="form-control" id="Nome" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Cognome</label>
                        @error('Cognome')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="Cognome" class="form-control" id="Cognome" placeholder="Cognome">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Grado</label>
                        @error('Grado')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="Grado" class="form-control" id="Grado" placeholder="Grado">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Cip</label>
                        @error('CIP')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <input type="text" name="CIP" class="form-control" id="Cip" placeholder="Cip">
                    </div>
                    {{@csrf_field()}}
                    <div>
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>

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
