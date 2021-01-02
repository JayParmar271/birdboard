<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/projects">
        @csrf 
        <h1>Create Project</h1>
        
        <p>Title</p>
        <input type="text" name="title">
        <p>Description</p>
        <input type="text" name="description">
        <p><button type="submit">Create Project</button></p>
    </form>
</body>
</html>