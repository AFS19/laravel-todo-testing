<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();

        return view('todos.index', [
            'todos' => $todos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255'
        ]);

        // 2. Create the todos
        Todo::create($validated);

        // 3. Redirect back with success message
        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo created successfully!');
    }
        public function toggle(Todo $todo)
        {
            try {
                // Make sure 'completed' is in $fillable array
                $todo->update([
                    'completed' => !$todo->completed
                ]);

                return redirect()
                    ->route('todos.index')
                    ->with('success', 'Todo status updated!');
            } catch (\Exception $e) {
                return redirect()
                    ->route('todos.index')
                    ->with('error', 'Failed to update todos status.');
            }

        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
