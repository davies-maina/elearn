<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfirmEmailTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_confrim_email()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->get("/register/confirm/?token={$user->confirm_token}")
            ->assertRedirect('/');

        $this->assertTrue($user->isConfirmed());
    }
}
