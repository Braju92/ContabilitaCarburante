<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function Guest_Non_Vede_Home_Test()
    {
        $response = $this->get('/home')->assertRedirect('/login');
    }

    /** @test */
    public function Utente_Vede_Home_Test()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/home')->assertOk();

    }

    /** @test */
    public function Guest_Non_Vede_Visualizza_Test()
    {
        $response = $this->get('/Visualizza')->assertRedirect('/login');
    }


    /** @test */
    public function Utente_Vede_Visualizza_Test()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/Visualizza')->assertOk();

    }

    /** @test */
    public function Guest_Non_Vede_Inserimento_Test()
    {
        $response = $this->get('/Visualizza')->assertRedirect('/login');
    }

    /** @test */
    public function Utente_Vede_Inserimento_Test()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/Inserimento')->assertOk();

    }

    /** @test */
    public function Guest_Non_Vede_Elimina_Test()
    {
        $response = $this->get('/Elimina')->assertRedirect('/login');
    }

    /** @test */
    public function Utente_Vede_Elimina_Test()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/Elimina')->assertOk();

    }

    /** @test */
    public function Guest_Non_Vede_Fogli_Test()
    {
        $response = $this->get('/Fogli')->assertRedirect('/login');
    }

    /** @test */
    public function Utente_Vede_Fogli_Test()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/Fogli')->assertOk();

    }
}
