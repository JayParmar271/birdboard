<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Let's start something new</h1>

    <form method="POST" action="/projects">
        @include('projects.form', [
            'project' => new App\Models\Project,
            'buttonText' => 'Create Project',
        ])
    </form>
</body>
</html>