<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BookTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function authenticated_user_should_create_a_book()
    {
        // login/register a user
        $token = $this->post('/api/v1/register', [
            'email' => 'example@email.com',
            'name' => 'John Doe',
            'password' => 'passwordexample2019',
        ]);
        
        // create a new book 
        $response = $this->post('/api/v1/books', [
            'title' => 'This is my Book Title',
            'description' => 'This is the description of cthe fictional book',
        ], );

        // $response->assertStatus(200);
        // $response->assertJsonStructure();
    }
}
