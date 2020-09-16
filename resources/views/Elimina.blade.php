@extends('layouts.app')

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
                <h4 class="mt-2">Elimina dati rifornimento</h4>
                <h6 class="mt-2" style="color: red;font-style: italic">Attenzione: è fortemente sconsigliato rimuovere rifornimenti.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Usare solo in caso di inserimento errato.</h6>
                <form action="viewdeleterifornimento" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Targa</label>
                        <input type="text" class="form-control" name="Targa" id="Targa" placeholder="Targa">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Data acquisto</label>
                        <input type="text" class="form-control" name="DataRifornimento" id="DataRifornimento"
                               placeholder="YYYY-MM-DD">
                    </div>
                    {{@csrf_field()}}
                    <div>
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Tab delle Cedole -->

        <div class="tab-pane fade" id="cedola">
            <div class="container-fluid">
                <h4 class="mt-2">Elimina gruppo di cedole</h4>
                <h6 class="mt-2" style="color: red;font-style: italic">Attenzione: è fortemente sconsigliato rimuovere gruppi di cedole.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Usare solo in caso di inserimento errato.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Non sarà possibile rimuovere gruppi di cedole qualora cedole appartenenti a questo gruppo fossero già state utilizzate in rifornimenti.</h6>
                <form action="viewdeletecedole" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Carburante</label>
                        <select class="custom-select custom-select" name="Carburante">
                            <option selected>Tipo carburante</option>
                            <option value="B">Benzina</option>
                            <option value="G">Gasolio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Ente</label>
                        <input type="text" class="form-control" name="Ente" id="Ente" placeholder="Ente">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Prezzo</label>
                        <input type="text" class="form-control" name="Prezzo" id="Euro" placeholder="€">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Taglio</label>
                        <input type="text" class="form-control" name="Taglio" id="Taglio" placeholder="Taglio">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Data acquisto</label>
                        <input type="text" class="form-control" name="Data" id="DataCedole" placeholder="YYYY-MM-DD">
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
                <h4 class="mt-2">Elimina dati cisterna</h4>
                <h6 class="mt-2" style="color: red;font-style: italic">Attenzione: è fortemente sconsigliato rimuovere immissioni di carburante in Cisterna.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Usare solo in caso di inserimento errato.</h6>
                <form action="viewdeletecisterna" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Data</label>
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
                <h4 class="mt-2">Elimina dati additivi</h4>
                <h6 class="mt-2" style="color: red;font-style: italic">Attenzione: è fortemente sconsigliato rimuovere additivi.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Usare solo in caso di inserimento errato.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Non sarà possibile rimuovere additivi qualora essi fossero già state utilizzati in rifornimenti.</h6>

                <form action="viewdeleteadditivi" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Codice Additivo</label>
                        <input type="text" name="CodiceAdditivo" class="form-control" id="CodiceAdditivo"
                               placeholder="Codice Additivo">
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
                <h4 class="mt-2">Elimina dati veicolo</h4>
                <h6 class="mt-2" style="color: red;font-style: italic">Attenzione: è fortemente sconsigliato rimuovere veicoli.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Usare solo in caso di inserimento errato.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Non sarà possibile rimuovere veicoli qualora essi avessero già fatto almeno un rifornimento.</h6>
                <form action="viewdeleteparco" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Targa</label>
                        <input type="text" name="Targa" class="form-control" id="TargaParco" placeholder="Targa">
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
                <h4 class="mt-2">Elimina dati dipendente</h4>
                <h6 class="mt-2" style="color: red;font-style: italic">Attenzione: è fortemente sconsigliato rimuovere dipendenti.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Usare solo in caso di inserimento errato.</h6>
                <h6 class="mt-2" style="color: red;font-style: italic">Non sarà possibile rimuovere dipendenti qualora essi avessero già preso parte a un rifornimento.</h6>
                <form action="viewdeletedipendenti" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Cip</label>
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
