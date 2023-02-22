<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * Test if the view login form returns a 200 response.
     *
     * @return void
     */
    public function test_view_login_form_returns_200_response()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * Test if an authenticated user is redirected to the home page
     * when trying to access the login form.
     *
     * @return void
     */
    public function test_authenticated_user_cannot_view_login_form()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/');
    }

    /**
     * Test if a user can login with correct credentials and is redirected to home page.
     *
     * @return void
     */
    public function test_user_can_login_with_correct_credentials_and_is_redirected_to_home_page()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = env('APP_NAME')),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/');
    }

    /**
     * Test if a user is authenticated after logging in with correct credentials.
     *
     * @return void
     */
    public function test_user_is_authenticated_after_logging_in_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = env('APP_NAME')),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
        $this->assertAuthenticatedAs($user);
    }
    
    /**
     * Test if a user is not authenticated after providing incorrect credentials.
     *
     * @return void
     */
    public function test_user_is_not_authenticated_after_providing_incorrect_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt(env('APP_NAME')),
        ]);
    
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'incorrect-password',
        ]);
    
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
    
    /**
     * Test if a user can logout successfully.
     *
     * @return void
     */
    public function test_user_can_logout_successfully()
    {
        $user = User::factory()->create();
    
        $response = $this->actingAs($user)->post('/logout');
    
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}