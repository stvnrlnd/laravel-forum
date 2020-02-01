<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MentionUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mentioned_users_in_a_reply_are_notified()
    {
        $john = create('App\User', [
            'name' => 'JohnDoe'
        ]);

        $this->signIn($john);

        $jane = create('App\User', [
            'name' => 'JaneDoe'
        ]);

        $thread = create('App\Thread');

        $reply = create('App\Reply', [
            'body' => '@JaneDoe look at this! Also @FrankDoe'
        ]);

        $this->json('post', $thread->path().'/replies', $reply->toArray());

        $this->assertCount(1, $jane->notifications);
    }
}
