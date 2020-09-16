<?php

namespace Tests\Feature;

use App\ListaAdditivi;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteAdditiviTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function Eliminazione_Additivo_Valido_Test(){

        $this->actingAs(factory(User::class)->create());

        factory(ListaAdditivi::class)->create();

        $this->assertCount(1,ListaAdditivi::all());

        $response = $this->post('deleteadditivi',$this->ValidData());

        $this->assertCount(0,ListaAdditivi::all());

    }

    /** @test */
    public function Eliminazione_Additivo_Codice_Assente(){

        $this->actingAs(factory(User::class)->create());

        factory(ListaAdditivi::class)->create();

        $this->assertCount(1,ListaAdditivi::all());

        $response = $this->post('deleteadditivi',array_merge($this->ValidData(),['CodiceAdditivo'=>'']));
        $response->assertSessionHasErrors('CodiceAdditivo');

        $this->assertCount(1,ListaAdditivi::all());

    }

    /** @test */
    public function Eliminazione_Additivo_Codice_Diverso_Da_Size(){

        $this->actingAs(factory(User::class)->create());

        factory(ListaAdditivi::class)->create();

        $this->assertCount(1,ListaAdditivi::all());

        $response = $this->post('deleteadditivi',array_merge($this->ValidData(),['CodiceAdditivo'=>'1234.12.123.12345']));
        $response->assertSessionHasErrors('CodiceAdditivo');

        $this->assertCount(1,ListaAdditivi::all());

    }

    /** @test */
    public function Eliminazione_Additivo_CodiceAdditivo_Diverso_Dal_Validate(){

        $this->actingAs(factory(User::class)->create());

        factory(ListaAdditivi::class)->create();

        $this->assertCount(1,ListaAdditivi::all());

        $response = $this->post('deleteadditivi',array_merge($this->ValidData(),['CodiceAdditivo'=>'1234567890123456']));
        $response->assertSessionHasErrors('CodiceAdditivo');

        $this->assertCount(1,ListaAdditivi::all());

    }


    private function ValidData(){
        return[

            'CodiceAdditivo' => '1234.12.123.1234'

        ];
    }

}
