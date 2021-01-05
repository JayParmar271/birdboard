@csrf 

<p>Title</p>
<input type="text" name="title" value="{{ $project->title }}"> 
<p>Description</p>
<input type="text" name="description" value="{{ $project->description }}">
<p><button type="submit">{{ $buttonText }}</button></p>
