<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_register_a_user()
    {

        $response = $this->post('/api/v1/register', [
            'email' => 'example@email.com',
            'name' => 'John Doe',
            'password' => 'passwordexample2019',
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
    }

    /**@test */
    public function return_error_if_registration_data_is_not_complete()
    {
        $response = $this->post('/api/v1/register', [
            'email' => 'example@email.com',
            'password' => 'passwordexample2019',
        ]);

        $response->assertJsonStructure([
            'errors'
        ]);

    }
    /** @test */
    public function it_should_login_user(){
        $this->post('/api/v1/register', [
            'email' => 'tvpeter@email.com',
            'name' => 'Tyonum Petr',
            'password' => 'password2019',
        ]);

        $response = $this->post('/api/v1/login', [
            'email' => 'tvpeter@gmail.com',
            'password' => 'password2019',
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_on',
        ]);
    }

    /** @test */
    public function it_will_not_log_an_invalid_user_in()
    {
        $this->post('/api/v1/register', [
            'email' => 'tvpeter@email.com',
            'name' => 'Tyonum Petr',
            'password' => 'password2019',
        ]);
        $response = $this->post('api/v1/login', [
            'email'    => 'tvpeter@email.com',
            'password' => 'invalidpasswordhere'
        ]);
        $response->assertJsonStructure([
            'error',
        ]);
    }

    /** @test */
    public function it_should_log_a_user_out()
    {
        $this->post('/api/v1/register', [
            'email' => 'tvpeter@email.com',
            'name' => 'Tyonum Petr',
            'password' => 'password2019',
        ]);
        
        $response = $this->post('/api/v1/logout')
            ->assertJson(['message' => 'successfully logged out'])
            ->assertStatus(200);

    }
}
