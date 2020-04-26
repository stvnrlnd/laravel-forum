<?php

namespace Tests\Feature;

use App\Mail\PleaseConfirmYourEmail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration()
    {
        Mail::fake();

        $this->post(route('register'), [
            'name' => 'Bob',
            'email' => 'bob@blob.gob',
            'password' => 'BadPassword',
            'password_confirmation' => 'BadPassword',
        ]);

        Mail::assertQueued(PleaseConfirmYourEmail::class);
    }

    /** @test */
    public function users_can_fully_confirm_their_email_addresses()
    {
        Mail::fake();

        $this->post(route('register'), [
            'name' => 'Bob',
            'email' => 'bob@blob.gob',
            'password' => 'BadPassword',
            'password_confirmation' => 'BadPassword',
        ]);

        $user = User::whereName('Bob')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);

        $response = $this->get('register/confirm?token='.$user->confirmation_token)
            ->assertRedirect(route('threads'));

        $this->assertTrue($user->fresh()->confirmed);
        $this->assertNull($user->fresh()->confirmation_token);
    }

    /** @test */
    public function an_invalid_token_will_not_confirm_a_user()
    {
        $this->get('/register/confirm?token=invalid')
            ->assertRedirect(route('threads'))
            ->assertSessionHas('flash', 'Unknonw token.');
    }
}
