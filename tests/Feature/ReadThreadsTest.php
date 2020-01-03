<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_to_a_thread()
    {
        $reply = create('App\Reply', [
            'thread_id' => $this->thread->id,
        ]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', [
            'channel_id' => $channel->id,
        ]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', [
            'name' => 'John',
        ]));

        $threadByJohn = create('App\Thread', [
            'user_id' => auth()->id(),
        ]);
        $threadNotByJohn = create('App\Thread');

        $this->get('threads?by=John')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithZeroReplies = $this->thread;

        $repnonse = $this->getJson('threads?popular')->json();

        $this->assertEquals([3, 2, 0], array_column($repnonse, 'replies_count'));
    }

    /** @test */
    public function the_user_can_request_all_replies_a_given_thread()
    {
        $thread = create('App\Thread');
        create('App\Reply', ['thread_id' => $thread->id], 2);

        $response = $this->getJson($thread->path().'/replies')->json();

        $this->assertCount(1, $response['data']);
        $this->assertCount(2, $response['total']);
    }
}
