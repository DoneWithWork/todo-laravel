<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function show(): View
    {
        $todos = Todo::orderBy('completed', 'asc')->get();
        return view(
            'welcome',
            [
                'todos' => $todos
            ]
        );
    }

    public function create(Request $request)
    {
        $data = request()->all();
        if (isset($data['title']) && isset($data['description'])) {
            $newTodo = new Todo([
                'title' => $data['title'],
                'description' => $data['description'],

            ]);
            $newTodo->save();
            return redirect()->route('home')->with('success', 'Todo created successfully');
        } else {
            return redirect()->route('home')->with('error', 'Failed to create todo');
        }
    }
    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->completed = $request->input('completed');
        $todo->save();

        return response()->json(['message' => 'Todo updated successfully', 'todo' => $todo]);
    }
}
