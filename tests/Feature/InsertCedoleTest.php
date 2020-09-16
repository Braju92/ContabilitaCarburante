<?php

namespace Tests\Feature;

use App\Cedole;
use App\TipoCedole;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsertCedoleTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function Inserimento_Cedole_Valido_Test(){

        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',$this->ValidData());

        $this->assertCount(1,TipoCedole::all());
        $this->assertCount(10,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Da_A_Diverso_Da_Numero_Test(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Numero'=>'8']));

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Carburante_Manomesso_Test(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Carburante'=>'C']));

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Ente_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Ente'=>'']));
        $response->assertSessionHasErrors('Ente');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Ente_Non_Alfanumerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Ente'=>'abc123!']));
        $response->assertSessionHasErrors('Ente');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Ente_Superiore_A_Max(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Ente'=>'abcdeabcdeabcdeabcdeabcdea']));
        $response->assertSessionHasErrors('Ente');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Prezzo_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Prezzo'=>'']));
        $response->assertSessionHasErrors('Prezzo');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Prezzo_Diverso_Da_Validate(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Prezzo'=>'1,2']));
        $response->assertSessionHasErrors('Prezzo');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Taglio_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Taglio'=>'']));
        $response->assertSessionHasErrors('Taglio');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Taglio_Non_Numerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Taglio'=>'1,234']));
        $response->assertSessionHasErrors('Taglio');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Numero_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Numero'=>'']));
        $response->assertSessionHasErrors('Numero');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Numero_Non_Numerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Numero'=>'1,234']));
        $response->assertSessionHasErrors('Numero');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Data_Assente(){

    $this->actingAs(factory(User::class)->create());

    $response = $this->post('insertcedole',array_merge($this->ValidData(),['Data'=>'']));
    $response->assertSessionHasErrors('Data');

    $this->assertCount(0,TipoCedole::all());
    $this->assertCount(0,Cedole::all());

}

    /** @test */
    public function Inserimento_Cedole_Data_Non_Data(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Data'=>'abc']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Da_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Da'=>'']));
        $response->assertSessionHasErrors('Da');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_Da_Non_Numerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['Da'=>'1,234']));
        $response->assertSessionHasErrors('Da');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_A_Assente(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['A'=>'']));
        $response->assertSessionHasErrors('A');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Inserimento_Cedole_A_Non_Numerico(){

        $this->actingAs(factory(User::class)->create());

        $response = $this->post('insertcedole',array_merge($this->ValidData(),['A'=>'1,234']));
        $response->assertSessionHasErrors('A');

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }



    private function ValidData(){
        return[

            'Carburante' => 'B',
            'Ente' => 'EnteProva',
            'Prezzo' => '1.234',
            'Taglio' => '10.00',
            'Numero' => '10',
            'Data' => '2020-01-01',
            'Da' => '1',
            'A' => '10'

        ];
    }

}
