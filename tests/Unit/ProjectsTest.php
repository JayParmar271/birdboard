<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_it_has_a_path()
    {
        $project = \App\Models\Project::factory()->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    public function test_belongs_to_owner()
    {
        $project = \App\Models\Project::factory()->create();

        $this->assertInstanceOf('App\Models\User', $project->owner);
    }
}
