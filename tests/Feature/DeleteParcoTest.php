<?php

namespace Tests\Feature;

use App\Parco;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteParcoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function Eliminazione_Parco_Valido_Test(){

        $this->actingAs(factory(User::class)->create());
        factory(Parco::class)->create();

        $this->assertCount(1,Parco::all());

        $response = $this->post('deleteparco',$this->ValidData());

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Eliminazione_Parco_Targa_Assente(){

        $this->actingAs(factory(User::class)->create());
        factory(Parco::class)->create();

        $this->assertCount(1,Parco::all());

        $response = $this->post('deleteparco',array_merge($this->ValidData(),['Targa'=>'']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(1,Parco::all());

    }

    /** @test */
    public function Eliminazione_Parco_Targa_Diversa_Dal_Size(){

        $this->actingAs(factory(User::class)->create());
        factory(Parco::class)->create();

        $this->assertCount(1,Parco::all());

        $response = $this->post('deleteparco',array_merge($this->ValidData(),['Targa'=>'AA1111']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(1,Parco::all());

    }

    /** @test */
    public function Eliminazione_Parco_Targa_Diversa_Dal_validate(){

        $this->actingAs(factory(User::class)->create());
        factory(Parco::class)->create();

        $this->assertCount(1,Parco::all());

        $response = $this->post('deleteparco',array_merge($this->ValidData(),['Targa'=>'AAA11']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(1,Parco::all());

    }


    private function ValidData(){
        return[

            'Targa' => 'AA111'

        ];
    }

}
