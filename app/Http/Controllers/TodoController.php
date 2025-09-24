<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $is_completed = $request->has('is_completed');

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $is_completed,
            'completed_at' => $is_completed ? Carbon::now() : null,
        ]);

        return redirect()->route('todos.index')->with('success', 'To-Do berhasil ditambahkan!');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todos.index')->with('success', 'To-Do berhasil diperbarui!');
    }

    public function complete(Todo $todo)
    {
        $todo->update([
            'is_completed' => true,
            'completed_at' => Carbon::now(),
        ]);

        return redirect()->route('todos.index')->with('success', 'To-Do berhasil diselesaikan!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'To-Do berhasil dihapus.');
    }
}