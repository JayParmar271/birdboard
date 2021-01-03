<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'notes' => 'General notes here'
        ];

        $response = $this->post('/projects', $attributes);
        
        $project = Project::where($attributes)->first();

        $response->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    public function test_user_can_update_a_project()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->patch($project->path(), [
            'notes' => 'changed'
        ])->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', ['notes' => 'changed']);
    }

    public function test_user_can_view_their_project()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project = \App\Models\Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_unauthenticated_user_cannot_view_the_project_of_others()
    {
        $this->signIn();

        $project = \App\Models\Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_update_the_project_of_others()
    {
        $this->signIn();

        $project = \App\Models\Project::factory()->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }

    public function test_project_requires_title()
    {
        $this->signIn();

        $attributes = \App\Models\Project::factory()->raw(['title' => '']);

        $this->post('projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_project_requires_description()
    {
        $this->signIn();

        $attributes = \App\Models\Project::factory()->raw(['description' => '']);

        $this->post('projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_guest_user_can_not_manage_projects()
    {
        $project = \App\Models\Project::factory()->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }
}
