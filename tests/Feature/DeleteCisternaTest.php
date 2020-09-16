<?php

namespace Tests\Feature;

use App\DepositoCisterna;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteCisternaTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function Eliminazione_Cisterna_Valido_Test(){

        $this->actingAs(factory(User::class)->create());
        factory(DepositoCisterna::class)->create();

        $this->assertCount(1,DepositoCisterna::all());

        $response = $this->post('deletecisterna',$this->ValidData());

        $this->assertCount(0,DepositoCisterna::all());

    }

    /** @test */
    public function Eliminazione_Cisterna_Data_Assente(){

        $this->actingAs(factory(User::class)->create());
        factory(DepositoCisterna::class)->create();

        $this->assertCount(1,DepositoCisterna::all());

        $response = $this->post('deletecisterna',array_merge($this->ValidData(),['Data'=>'']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(1,DepositoCisterna::all());

    }

    /** @test */
    public function Eliminazione_Cisterna_Data_Diverso_Da_Data(){

        $this->actingAs(factory(User::class)->create());
        factory(DepositoCisterna::class)->create();

        $this->assertCount(1,DepositoCisterna::all());

        $response = $this->post('deletecisterna',array_merge($this->ValidData(),['Data'=>'abc']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(1,DepositoCisterna::all());

    }

    private function ValidData(){
        return[

            'Data' => '2020-01-01',

        ];
    }

}
