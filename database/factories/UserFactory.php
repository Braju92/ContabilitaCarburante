<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AdditiviRifornimento;
use App\User;
use App\ListaAdditivi;
use App\Cedole;
use App\DepositoCisterna;
use App\Dipendenti;
use App\Parco;
use App\Rifornimenti;
use App\ConsumiRifornimento;
use App\TipoCedole;
use App\UtilizzoCedola;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Additivirifornimento::class, function (Faker $faker) {
    return [
        'IDRifornimento'=>'1',
        'TipoAdditivi' =>'1234.12.123.1234',
        'LitriAdditivi' => '10.00'
    ];


});

$factory->define(Cedole::class, function (Faker $faker) {
    return [
        'IDCedola'=>'1',
        'TipoCedola' =>'1',
        'ImportoRimanente'=>'10.00'
    ];


});

$factory->define(ConsumiRifornimento::class, function (Faker $faker) {
    return [
        'Data'=>'2020-01-01',
        'Targa' =>'AA111',
        'KmAttuali' => '100',
        'Step' => '1'
    ];


});

$factory->define(DepositoCisterna::class, function (Faker $faker) {
    return [
        'Data'=>'2020-01-01',
        'LitriBenzinaRimanenti' =>'0',
        'LitriGasolioRimanenti' => '0'
    ];


});

$factory->define(Dipendenti::class, function (Faker $faker) {
    return [
        'Nome'=>'NomeProva',
        'Cognome' =>'CognomeProva',
        'Grado' => 'Gra',
        'CIP' => 'CIPPRO12'
    ];


});

$factory->define(ListaAdditivi::class, function (Faker $faker) {
    return [
        'CodiceAdditivo'=>'1234.12.123.1234',
        'TipoAdditivo' =>'Tipo'
    ];


});

$factory->define(Parco::class, function (Faker $faker) {
    return [
        'Targa'=>'AA111',
        'Reparto' =>'RepartoProva',
        'Tipo' => 'TipoProva',
        'Alimentazione' => 'B',
        'Consumo100Km' => '1.234'
    ];


});

$factory->define(Rifornimenti::class, function (Faker $faker) {
    return [
        'IDRifornimento'=>'1',
        'Targa' =>'AA111',
        'RifornimentoLitri' => '10.00',
        'Conduttore' => 'CIPPRO12',
        'Data' => '2020-01-01',
        'EuroLitro' => '1.234',
        'Cisterna' => '1'
    ];


});

$factory->define(TipoCedole::class, function (Faker $faker) {
    return [
        'IDGruppo'=>'1',
        'Carburante' =>'B',
        'Ente'=>'EnteProva',
        'Prezzo'=>'1.234',
        'Numero'=>'2',
        'Taglio' => '10.00',
        'DataAcquisizione' => '2020-01-01'
    ];


});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(UtilizzoCedola::class, function (Faker $faker) {
    return [
        'IDRifornimento' => '1',
        'IDCedola' => '1',
        'Consumo' => '10.00'
    ];
});
