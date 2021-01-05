<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ $project->path() }}">
        @csrf 
        @method('PATCH')
        <h1>Edit Project</h1>
        
        <p>Title</p>
        <input type="text" name="title" value="{{ $project->title }}"> 
        <p>Description</p>
        <input type="text" name="description" value="{{ $project->description }}">
        <p><button type="submit">Update Project</button></p>
    </form>
</body>
</html>