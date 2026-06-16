<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $todos = Todo::where('user_id', $request->user()->id)->get();
        return $this->ok($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        $todo = Todo::create([
            'user_id' => $request->user()->id,
            'task' => $request->task,
            'done' => $request->done ?? false,
        ]);

        return $this->ok($todo, 'Todo created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return $this->ok($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->only('task', 'done'));
        return $this->ok($todo, 'Todo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return $this->ok(null, 'Todo deleted successfully');
    }
}
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
