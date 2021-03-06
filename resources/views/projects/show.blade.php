<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @forelse ($project->tasks as $task)
        <div>{{ $task->body }}</div>
    @empty
        <div>Begin adding tasks</div>
    @endforelse

    <h1><a href="{{ $project->path() . '/edit' }}">{{ $project->title }}</a></h1>
    <div>{{ $project->description }}</div>
    <div>{{ $project->notes }}</div>
</body>
</html>