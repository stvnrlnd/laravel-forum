<?php

namespace Tests\Unit;

use App\Inspections\Spam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamTest extends TestCase
{
    /** @test */
    public function it_checks_for_invalid_keywords()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Exception');

        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent reply.'));

        $spam->detect('Yahoo Customer Support');
    }

    /** @test */
    public function it_checks_for_any_key_being_held_down()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Exception');

        $spam = new Spam();

        $spam->detect('Hello World aaaaaaaaaa');
    }

}
