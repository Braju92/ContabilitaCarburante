<?php

namespace Tests\Feature;

use App\Parco;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsertParcoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function Inserimento_Parco_Valido_Test(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',$this->ValidData());

        $this->assertCount(1,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Targa_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Targa'=>'']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Targa_Diversa_Dal_Size(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Targa'=>'AA1111']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Targa_Diversa_Dal_validate(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Targa'=>'AAA11']));
        $response->assertSessionHasErrors('Targa');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Reparto_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Reparto'=>'']));
        $response->assertSessionHasErrors('Reparto');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Reparto_Superiore_Al_Max(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Reparto'=>'abcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdea']));
        $response->assertSessionHasErrors('Reparto');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Modello_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Modello'=>'']));
        $response->assertSessionHasErrors('Modello');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Modello_Superiore_Al_Max(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Modello'=>'abcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdeabcdea']));
        $response->assertSessionHasErrors('Modello');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Alimentazione_Manomessa(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Alimentazione'=>'C']));
        $response->assertSessionHasErrors('Alimentazione');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Consumo100Km_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Consumo100Km'=>'']));
        $response->assertSessionHasErrors('Consumo100Km');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Consumo100Km_Non_Numerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Consumo100Km'=>'a.234']));
        $response->assertSessionHasErrors('Consumo100Km');

        $this->assertCount(0,Parco::all());

    }

    /** @test */
    public function Inserimento_Parco_Consumo100Km_Diverso_Da_Validate(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertparco',array_merge($this->ValidData(),['Consumo100Km'=>'1,2']));
        $response->assertSessionHasErrors('Consumo100Km');

        $this->assertCount(0,Parco::all());

    }

    private function ValidData(){
        return[

            'Targa' => 'AA111',
            'Reparto' => 'RepartoValido',
            'Modello' => 'ModelloValido',
            'Alimentazione' => 'B',
            'Consumo100Km' => '1.234'

        ];
    }

}
