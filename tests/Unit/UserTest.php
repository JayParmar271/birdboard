<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_projects()
    {
        $user = \App\Models\User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}