<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>
   <main class="container">
    <h1>Simple Todo Page</h1>
    <div>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
        <form action="{{ route('new-todo') }}" method="post">
            @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" required>
        </div>
        <button type="submit">Create</button>
        </form>
     
            @foreach ($todos as $todo)
            <form class=" todo" >
            <p>{{ $todo->title }}</p>
            <p>{{ $todo->description }}</p>
        <input type="checkbox" {{ $todo->completed ? 'checked="checked"' : '' }}  onclick="updateTodoStatus({{ $todo->id }}, this.checked)" />
    </form>
        @endforeach
    </div>
   </main>
   <script>
    function updateTodoStatus(todoId, isCompleted) {
        fetch(`/todos/${todoId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'  // For Laravel CSRF protection
            },
            body: JSON.stringify({
                completed: isCompleted
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Update successful', data);
            
        })
        .catch(error => {
            console.error('Error updating todo:', error);
    
        });
    }
</script>

</body>
</html>