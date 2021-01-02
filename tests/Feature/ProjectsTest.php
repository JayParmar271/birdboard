<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

        $project = \App\Models\Project::factory()->create();

        $this->get('projects/' . $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_project_requires_title()
    {
        $attributes = \App\Models\Project::factory()->raw(['title' => '']);

        $this->post('projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_project_requires_description()
    {
        $attributes = \App\Models\Project::factory()->raw(['description' => '']);

        $this->post('projects', $attributes)->assertSessionHasErrors('description');
    }
}
