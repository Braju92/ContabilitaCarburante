<?php

namespace Tests\Feature;

use App\Cedole;
use App\TipoCedole;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteCedoleTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function Eliminazione_Cedole_Valido_Test(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',$this->ValidData());

        $this->assertCount(0,TipoCedole::all());
        $this->assertCount(0,Cedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Carburante_Diverso_Da_Size(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Carburante'=>'12']));
        $response->assertSessionHasErrors('Carburante');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Ente_Assente(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Ente'=>'']));
        $response->assertSessionHasErrors('Ente');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Ente_Non_Alfanumerico(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Ente'=>'abc123!']));
        $response->assertSessionHasErrors('Ente');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Ente_Superiore_A_Max(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Ente'=>'abcdeabcdeabcdeabcdeabcdea']));
        $response->assertSessionHasErrors('Ente');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Prezzo_Assente(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Prezzo'=>'']));
        $response->assertSessionHasErrors('Prezzo');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Prezzo_Diverso_Da_Validate(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Prezzo'=>'1,2']));
        $response->assertSessionHasErrors('Prezzo');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Taglio_Assente(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Taglio'=>'']));
        $response->assertSessionHasErrors('Taglio');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Taglio_Non_Numerico(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Taglio'=>'1,234']));
        $response->assertSessionHasErrors('Taglio');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }

    /** @test */
    public function Eliminazione_Cedole_Data_Assente(){

    $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    $response = $this->post('deletecedole',array_merge($this->ValidData(),['Data'=>'']));
    $response->assertSessionHasErrors('Data');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

}

    /** @test */
    public function Eliminazione_Cedole_Data_Non_Data(){

        $this->actingAs(factory(User::class)->create());

        factory(TipoCedole::class)->create();

        factory(Cedole::class)->create([
            'IDCedola'=>'1',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        factory(Cedole::class)->create([
            'IDCedola'=>'2',
            'TipoCedola' =>'1',
            'ImportoRimanente'=>'10.00'
        ]);
        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

        $response = $this->post('deletecedole',array_merge($this->ValidData(),['Data'=>'abc']));
        $response->assertSessionHasErrors('Data');

        $this->assertCount(2,Cedole::all());
        $this->assertCount(1,TipoCedole::all());

    }



    private function ValidData(){
        return[

            'Carburante' => 'B',
            'Ente' => 'EnteProva',
            'Prezzo' => '1.234',
            'Taglio' => '10.00',
            'Data' => '2020-01-01'

        ];
    }

}
