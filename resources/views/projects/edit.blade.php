<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Project</h1>

    <form method="POST" action="{{ $project->path() }}">
        @method('PATCH')
        
        @include('projects.form', [
            'buttonText' => 'Update Project'
        ])
    </form>
</body>
</html>