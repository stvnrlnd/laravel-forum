<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddAvatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guess_cannot_add_an_avatar()
    {
        $this->json('POST', 'api/users/1/avatar')
            ->assertStatus(401);
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $this->signIn();

        $this->json('POST', 'api/users/'.auth()->id().'/avatar', [
            'avatar' => 'not_an_image',
        ])->assertStatus(422);
    }

    /** @test */
    public function a_user_can_add_an_avatar()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('POST', 'api/users/'.auth()->id().'/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $this->assertEquals('avatars/'.$file->hashName(), auth()->user()->avatar_path);

        Storage::disk('public')
            ->assertExists('avatars/'.$file->hashName());
    }
}
