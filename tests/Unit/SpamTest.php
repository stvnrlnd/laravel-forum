<?php

namespace Tests\Unit;

use App\Spam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamTest extends TestCase
{
    /** @test */
    public function test_function()
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent reply.'));
    }
}
