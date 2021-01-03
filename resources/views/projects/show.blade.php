<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($project->tasks as $task)
        <div>{{ $task->body }}></div>
    @endforeach

    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>
</body>
</html>