<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_submitting_user_addition_without_filling_in_the_mandatory_fields()
    {
        $response = $this->actingAs(User::factory()->make());

        $response = $this->post('/cid10/create', [
            'status' => 'a',
            'title' => 'Test Teste',
            'code' => 'A0000'
        ]);

        $response->assertRedirect('/cid10');
    }
}
