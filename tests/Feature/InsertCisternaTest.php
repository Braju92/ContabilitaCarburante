<?php

namespace Tests\Feature;

use App\DepositoCisterna;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsertCisternaTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function Inserimento_Cisterna_Valido_Test(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcisterna',$this->ValidData());

        $this->assertCount(1,DepositoCisterna::all());

    }

    /** @test */
    public function Inserimento_Cisterna_Data_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcisterna',array_merge($this->ValidData(),['Data'=>'']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(0,DepositoCisterna::all());

    }

    /** @test */
    public function Inserimento_Cisterna_Data_Diverso_Da_Data(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcisterna',array_merge($this->ValidData(),['Data'=>'abc']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(0,DepositoCisterna::all());

    }

    /** @test */
    public function Inserimento_Cisterna_LitriImmessi_Assenti(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcisterna',array_merge($this->ValidData(),['LitriImmessi'=>'']));
        $response->assertSessionHasErrors('LitriImmessi');

        $this->assertCount(0,DepositoCisterna::all());

    }

    /** @test */
    public function Inserimento_Cisterna_LitriImmessi_Diversi_Da_Numero(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcisterna',array_merge($this->ValidData(),['LitriImmessi'=>'abc']));
        $response->assertSessionHasErrors('LitriImmessi');

        $this->assertCount(0,DepositoCisterna::all());

    }

    /** @test */
    public function Inserimento_Cisterna_Alimentazione_Manomesso(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcisterna',array_merge($this->ValidData(),['Alimentazione'=>'C']));
        $response->assertSessionHasErrors('Alimentazione');

        $this->assertCount(0,DepositoCisterna::all());

    }

    private function ValidData(){
        return[

            'Data' => '2020-01-01',
            'LitriImmessi' => '1',
            'Alimentazione' => 'B'

        ];
    }

}
