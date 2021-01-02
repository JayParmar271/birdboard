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
        $this->actingAs(\App\Models\User::factory()->create());

        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_user_can_view_their_project()
    {
        $this->be(\App\Models\User::factory()->create());

        $this->withoutExceptionHandling();

        $project = \App\Models\Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_unauthenticated_user_cannot_view_the_project_of_others()
    {
        $this->be(\App\Models\User::factory()->create());

        $project = \App\Models\Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_project_requires_title()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $attributes = \App\Models\Project::factory()->raw(['title' => '']);

        $this->post('projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_project_requires_description()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $attributes = \App\Models\Project::factory()->raw(['description' => '']);

        $this->post('projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_can_not_create_projects()
    {
        $attributes = \App\Models\Project::factory()->raw();

        $this->post('projects', $attributes)->assertRedirect('login');
    }

    public function test_guest_may_not_view_projects()
    {
        $this->get('projects')->assertRedirect('login');
    }

    public function test_guest_may_not_view_a_single_project()
    {
        $project = \App\Models\Project::factory()->create();

        $this->get($project->path())->assertRedirect('login');
    }
}
