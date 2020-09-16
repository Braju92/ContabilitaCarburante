<?php

namespace Tests\Feature;

use App\Dipendenti;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteDipendentiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function Eliminazione_Dipendente_Valido_Test(){

        $this->actingAs(factory(User::class)->create());
        factory(Dipendenti::class)->create();

        $this->assertCount(1,Dipendenti::all());

        $response = $this->post('deletedipendenti',$this->ValidData());

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Eliminazione_Dipendente_CIP_Assente(){

        $this->actingAs(factory(User::class)->create());
        factory(Dipendenti::class)->create();

        $this->assertCount(1,Dipendenti::all());

        $response = $this->post('deletedipendenti',array_merge($this->ValidData(),['CIP'=>'']));
        $response->assertSessionHasErrors('CIP');

        $this->assertCount(1,Dipendenti::all());

    }

    /** @test */
    public function Eliminazione_Dipendente_CIP_Diverso_Dal_Size(){

        $this->actingAs(factory(User::class)->create());
        factory(Dipendenti::class)->create();

        $this->assertCount(1,Dipendenti::all());

        $response = $this->post('deletedipendenti',array_merge($this->ValidData(),['CIP'=>'abcabc']));
        $response->assertSessionHasErrors('CIP');

        $this->assertCount(1,Dipendenti::all());

    }


    /** @test */
    public function Eliminazione_Dipendente_CIP_Diverso_Dal_Validate(){

        $this->actingAs(factory(User::class)->create());
        factory(Dipendenti::class)->create();

        $this->assertCount(1,Dipendenti::all());

        $response = $this->post('deletedipendenti',array_merge($this->ValidData(),['CIP'=>'abcabc123']));
        $response->assertSessionHasErrors('CIP');

        $this->assertCount(1,Dipendenti::all());

    }


    private function ValidData(){
        return[

            'CIP' => 'CIPPRO12'

        ];
    }

}
