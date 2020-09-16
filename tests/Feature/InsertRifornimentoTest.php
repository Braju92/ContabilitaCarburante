<?php

namespace Tests\Feature;

use App\AdditiviRifornimento;
use App\Cedole;
use App\ConsumiRifornimento;
use App\Rifornimenti;
use App\User;
use App\UtilizzoCedola;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsertRifornimentoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function Inserimento_Rifornimento_Cisterna_Valido_Test()
    {

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento', $this->ValidData());

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Distributore_Valido_Test()
    {

        $this->actingAs(factory(User::class)->create());
        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'20.00',
            ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'20.00']);

        $response = $this->post('insertrifornimento', array_merge($this->ValidData(), [
            'Cisterna' => '0',
            'TipoAdditivi1' => '1234.12.123.1234',
            'TipoAdditivi2' => '1234.12.123.1235',
            'LitriAdditivi1' => '10.00',
            'LitriAdditivi2' => '10.00',
            'IDCedola1' => '1',
            'IDCedola2' => '2',
            'ConsumoCedola1' => '10.00',
            'ConsumoCedola2' => '10.00',


        ]));

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());
        $this->assertCount(2, AdditiviRifornimento::all());
        $this->assertCount(2, UtilizzoCedola::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Cisterna_E_Cedole_Non_Valido_Test()
    {

        $this->actingAs(factory(User::class)->create());
        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'20.00',
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'20.00']);

        $response = $this->post('insertrifornimento', array_merge($this->ValidData(), [
            'Cisterna' => '1',
            'TipoAdditivi1' => '1234.12.123.1234',
            'TipoAdditivi2' => '1234.12.123.1235',
            'LitriAdditivi1' => '10.00',
            'LitriAdditivi2' => '10.00',
            'IDCedola1' => '1',
            'IDCedola2' => '2',
            'ConsumoCedola1' => '10.00',
            'ConsumoCedola2' => '10.00',


        ]));

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());
        $this->assertCount(0, AdditiviRifornimento::all());
        $this->assertCount(0, UtilizzoCedola::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Targa_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Targa'=>'']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Targa_Diversa_Dal_Size(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Targa'=>'AA1111']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Targa_Diversa_Dal_validate(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Targa'=>'AAA11']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_LitriRifornimento_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['LitriRifornimento'=>'']));
        $response->assertSessionHasErrors('LitriRifornimento');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_LitriRifornimento_Non_Numerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['LitriRifornimento'=>'a.234']));
        $response->assertSessionHasErrors('LitriRifornimento');

        $this->assertCount(0, Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_CIP_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['CIPConduttore'=>'']));
        $response->assertSessionHasErrors('CIPConduttore');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_CIP_Diverso_Dal_Size(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['CIPConduttore'=>'abcabc']));
        $response->assertSessionHasErrors('CIPConduttore');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }


    /** @test */
    public function Inserimento_Rifornimento_CIP_Diverso_Dal_Validate(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['CIPConduttore'=>'abcabc123']));
        $response->assertSessionHasErrors('CIPConduttore');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_CostoCarburanteLitro_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['CostoCarburanteLitro'=>'']));
        $response->assertSessionHasErrors('CostoCarburanteLitro');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_CostoCarburanteLitro_Diverso_Da_Validate(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['CostoCarburanteLitro'=>'1,2']));
        $response->assertSessionHasErrors('CostoCarburanteLitro');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Data_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Data'=>'']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Data_Non_Data(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Data'=>'abc']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Kilometraggio_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Kilometraggio'=>'']));
        $response->assertSessionHasErrors('Kilometraggio');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Kilometraggio_Non_Numerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Kilometraggio'=>'a.234']));
        $response->assertSessionHasErrors('Kilometraggio');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Cisterna_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Cisterna'=>'']));
        $response->assertSessionHasErrors('Cisterna');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Inserimento_Rifornimento_Cisterna_Non_Booleano(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertrifornimento',array_merge($this->ValidData(),['Cisterna'=>'2']));
        $response->assertSessionHasErrors('Cisterna');

        $this->assertCount(0,Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }


    private function ValidData()
    {
        return [

            'Targa' => 'AA111',
            'LitriRifornimento' => '10.00',
            'CIPConduttore' => 'CIPVAL12',
            'CostoCarburanteLitro' => '1.234',
            'Data' => '2020-01-01',
            'Kilometraggio' => '100',
            'Cisterna' => '1'

        ];
    }

}
