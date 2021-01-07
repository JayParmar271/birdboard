<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            Activity::create([
                'project_id' => $task->project->id,
                'description' => 'created_task',
            ]);
        });

        static::updated(function ($task) {
            if (! $task->completed) {
                return;
            }

            Activity::create([
                'project_id' => $task->project->id,
                'description' => 'completed_task',
            ]);
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
