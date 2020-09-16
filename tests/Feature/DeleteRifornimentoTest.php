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

class DeleteRifornimentoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function Eliminazione_Rifornimento_Cisterna_Valido_Test()
    {

        $this->actingAs(factory(User::class)->create());
        factory(Rifornimenti::class)->create();
        factory(ConsumiRifornimento::class)->create();

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

        $response = $this->post('deleterifornimento', $this->ValidData());

        $this->assertCount(0, Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());

    }

    /** @test */
    public function Eliminazione_Rifornimento_Distributore_Valido_Test()
    {

        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());
        factory(Rifornimenti::class)->create(['Cisterna' => '0']);
        factory(ConsumiRifornimento::class)->create();

        factory(Cedole::class)->create([
            'IDCedola' => '1',
            'TipoCedola' => '1',
            'ImportoRimanente' => '20.00',
        ]);
        factory(Cedole::class)->create([
            'IDCedola' => '2',
            'TipoCedola' => '1',
            'ImportoRimanente' => '20.00']);

        factory(AdditiviRifornimento::class)->create([
            'IDRifornimento' => '1',
            'TipoAdditivi' => '1234.12.123.1234',
            'LitriAdditivi' => '10.00'
        ]);
        factory(AdditiviRifornimento::class)->create([
            'IDRifornimento' => '1',
            'TipoAdditivi' => '1234.12.123.1235',
            'LitriAdditivi' => '10.00'
        ]);
        factory(UtilizzoCedola::class)->create([
            'IDRifornimento' => '1',
            'IDCedola' => '1',
            'Consumo' => '5.00'
        ]);
        factory(UtilizzoCedola::class)->create([
            'IDRifornimento' => '1',
            'IDCedola' => '2',
            'Consumo' => '10.00'
        ]);

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());
        $this->assertCount(2, AdditiviRifornimento::all());
        $this->assertCount(2, UtilizzoCedola::all());

        $response = $this->post('deleterifornimento', array_merge($this->ValidData(), [
            'Cisterna' => '0',
            'TipoAdditivi1' => '1234.12.123.1234',
            'TipoAdditivi2' => '1234.12.123.1235',
            'LitriAdditivi1' => '10.00',
            'LitriAdditivi2' => '10.00',
            'IDCedola1' => '1',
            'IDCedola2' => '2',
            'ConsumoCedola1' => '5.00',
            'ConsumoCedola2' => '5.00',


        ]));

        $this->assertCount(0, Rifornimenti::all());
        $this->assertCount(0, ConsumiRifornimento::all());
        $this->assertCount(0, AdditiviRifornimento::all());
        $this->assertCount(0, UtilizzoCedola::all());

    }

    /** @test */
    public function Eliminazione_Rifornimento_Targa_Assente()
    {

        $this->actingAs(factory(User::class)->create());
        factory(Rifornimenti::class)->create();
        factory(ConsumiRifornimento::class)->create();


        $response = $this->post('deleterifornimento', array_merge($this->ValidData(), ['Targa' => '']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

    }

    /** @test */
    public function Eliminazione_Rifornimento_Targa_Diversa_Dal_Size()
    {

        $this->actingAs(factory(User::class)->create());
        factory(Rifornimenti::class)->create();
        factory(ConsumiRifornimento::class)->create();

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

        $response = $this->post('deleterifornimento', array_merge($this->ValidData(), ['Targa' => 'AA1111']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

    }

    /** @test */
    public function Eliminazione_Rifornimento_Targa_Diversa_Dal_validate()
    {

        $this->actingAs(factory(User::class)->create());
        factory(Rifornimenti::class)->create();
        factory(ConsumiRifornimento::class)->create();

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

        $response = $this->post('deleterifornimento', array_merge($this->ValidData(), ['Targa' => 'AAA11']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

    }


    /** @test */
    public function Eliminazione_Rifornimento_Data_Assente()
    {

        $this->actingAs(factory(User::class)->create());
        factory(Rifornimenti::class)->create();
        factory(ConsumiRifornimento::class)->create();

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

        $response = $this->post('deleterifornimento', array_merge($this->ValidData(), ['Data' => '']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

    }

    /** @test */
    public function Eliminazione_Rifornimento_Data_Non_Data()
    {

        $this->actingAs(factory(User::class)->create());
        factory(Rifornimenti::class)->create();
        factory(ConsumiRifornimento::class)->create();

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

        $response = $this->post('deleterifornimento', array_merge($this->ValidData(), ['Data' => 'abc']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(1, Rifornimenti::all());
        $this->assertCount(1, ConsumiRifornimento::all());

    }


    private function ValidData()
    {
        return [

            'Targa' => 'AA111',
            'Data' => '2020-01-01'

        ];
    }

}
