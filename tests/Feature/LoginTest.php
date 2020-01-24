<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_for_successfull_login()
    {

        $user = factory(User::class)->create();

        $this->postJson('/login', [

            'email' => $user->email,
            'password' => 'secret'
        ])->assertStatus(200)->assertJson([
            'status' => 'ok'
        ])->assertSessionHas('success', 'successfully loggd in');
    }
    public function test_login_wrong_credentials_text()
    {
        /* $this->assertTrue(true); */
        $user = factory(User::class)->create();

        $this->postJson('/login', [

            'email' => $user->email,
            'password' => 'wrong-password'
        ])->assertStatus(422)->assertJson([
            'message' => 'credentials dont match our records'
        ]);
    }
}
