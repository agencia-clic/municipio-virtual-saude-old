<?php

namespace Tests\Feature\Home;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_is_login_home()
    {
        $response = $this->actingAs(User::factory()->make())->get('/login');
        $response->assertRedirect('/home');
    }
}
