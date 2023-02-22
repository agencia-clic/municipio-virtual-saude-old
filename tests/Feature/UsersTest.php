<?php

namespace Tests\Feature;

use App\Models\Admin\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class UsersTest extends TestCase
{
    use RefreshDatabase, WithFaker, DatabaseMigrations;

    /** @test */
    public function  a_user_can_submit_a_form_validates_required_fields()
    {
        // Simulate a user going through the login screen
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->withoutExceptionHandling();
        $this->expectException(ValidationException::class);

        $response = $this->postJson(route('users.create'), []);
        $response->assertValidationErrors(['name', 'email', 'password', 'status', 'level']);

        $response = $this->postJson(route('users.create'), ['status' => 'not']);
        $response->assertValidationErrors(['status']);

        $response = $this->postJson(route('users.create'), ['level' => 'not']);
        $response->assertValidationErrors(['level']);
    }

    /** @test */
    public function a_user_can_submit_a_form()
    {
        // Simulate a user going through the login screen
        $user = User::factory()->create();
        $this->actingAs($user);

        //users generate fake
        $user_new = User::factory()->make();

        $data = [
            'name' => $user_new->name,
            'status' => $user_new->status,
            'email' => $user_new->email,
            'password' => $user_new->password,
            'password_confirmation' => $user_new->password,
            'level' => $user_new->level,
        ];
        
        // Submit the form
        $response = $this->postJson(route('users.create'), $data);

        // verifi insert data base
        $this->assertDatabaseHas('users', [
            'name' => $user_new->name,
            'status' => $user_new->status,
            'email' => $user_new->email,
            'level' => $user_new->level,
        ]);

        //Assert that the form was submitted successfully
        $response->assertRedirect(route('users'));

        // listed name
        $this->get(route('users'))->assertSeeText($user_new->name);
    }

    /** @test */
    public function a_is_inserted_and_listed()
    {
        // Simulate a user going through the login screen
        $user = User::factory()->create();
        $this->actingAs($user);

        //users generate fake
        $user_new = User::factory()->make();

        $data = [
            'name' => $user_new->name,
            'status' => $user_new->status,
            'email' => $user_new->email,
            'password' => $user_new->password,
            'password_confirmation' => $user_new->password,
            'level' => $user_new->level,
        ];

        // insert
        $this->json('POST', route('users.create'), $data);

        // verifi insert data base
        $this->assertDatabaseHas('users', [
            'name' => $user_new->name,
            'status' => $user_new->status,
            'email' => $user_new->email,
            'level' => $user_new->level,
        ]);

        // listed name
        $this->get(route('users'))->assertSeeText($user_new->name);
    }

    /** @test */
    public function a_user_can_submit_a_form_update()
    {
        // Simulate a user going through the login screen
        $user = User::factory()->create();
        $this->actingAs($user);

        //users generate fake
        $users = User::factory()->create();
        $user_new = User::factory()->make();

        $data = [
            'name' => $user_new->name,
            'status' => $user_new->status,
            'email' => $user_new->email,
            'password' => $user_new->password,
            'password_confirmation' => $user_new->password,
            'level' => $user_new->level,
        ];

        $response = $this->postJson(route('users.update', ['IdUsers' => base64_encode($users->IdUsers)]), $data);

        // verifi insert data base
        $this->assertDatabaseHas('users', [
            'name' => $user_new->name,
            'status' => $user_new->status,
            'email' => $user_new->email,
            'level' => $user_new->level,
        ]);

        //Assert that the form was submitted successfully
        $response->assertRedirect(route('users'));
    }

    /** @test */
    public function a_is_deleted()
    {
        $users = User::factory()->create();
        $response = $this->delete(route('users.delete', ['IdUsers' => base64_encode($users->IdUsers)]));

        $response->assertStatus(200); // check status code
        $this->assertDatabaseMissing('users', [
            'IdUsers' => $users->IdUsers,
        ]);
    }
}
