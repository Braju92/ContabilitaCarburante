<?php

namespace Tests\Feature;

use App\Dipendenti;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsertDipendentiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function Inserimento_Dipendente_Valido_Test(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',$this->ValidData());

        $this->assertCount(1,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Nome_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Nome'=>'']));
        $response->assertSessionHasErrors('Nome');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Nome_Non_Alfabetico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Nome'=>'abcde123']));
        $response->assertSessionHasErrors('Nome');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Nome_Superiore_Al_Max(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Nome'=>'abcdeabcdeabcdeabcdeabcdea']));
        $response->assertSessionHasErrors('Nome');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Cognome_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Cognome'=>'']));
        $response->assertSessionHasErrors('Cognome');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Cognome_Non_Alfabetico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Cognome'=>'abcde123']));
        $response->assertSessionHasErrors('Cognome');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Cognome_Superiore_Al_Max(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Cognome'=>'abcdeabcdeabcdeabcdeabcdea']));
        $response->assertSessionHasErrors('Cognome');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Grado_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Grado'=>'']));
        $response->assertSessionHasErrors('Grado');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Grado_Non_Alfanumerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Grado'=>'abcde123']));
        $response->assertSessionHasErrors('Grado');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_Grado_Diverso_Da_Size(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['Grado'=>'abcd']));
        $response->assertSessionHasErrors('Grado');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_CIP_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['CIP'=>'']));
        $response->assertSessionHasErrors('CIP');

        $this->assertCount(0,Dipendenti::all());

    }

    /** @test */
    public function Inserimento_Dipendente_CIP_Diverso_Dal_Size(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['CIP'=>'abcabc']));
        $response->assertSessionHasErrors('CIP');

        $this->assertCount(0,Dipendenti::all());

    }


    /** @test */
    public function Inserimento_Dipendente_CIP_Diverso_Dal_Validate(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertdipendenti',array_merge($this->ValidData(),['CIP'=>'abcabc123']));
        $response->assertSessionHasErrors('CIP');

        $this->assertCount(0,Dipendenti::all());

    }


    private function ValidData(){
        return[

            'Nome' => 'NomeValido',
            'Cognome' => 'CognomeValido',
            'Grado' => 'Gra',
            'CIP' => 'CIPVAL12'

        ];
    }

}
