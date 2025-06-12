<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('dashboard', [
                'tasks' => collect(), // Rỗng nếu chưa đăng nhập
            ]);
        }

        $tasks = Auth::user()->tasks()->get();

        return view('tasks.index', [
                'tasks' => $tasks,
            ]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
        ]);

        Auth::user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);

        $tasks = Auth::user()->tasks()->get();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            $tasks = Auth::user()->tasks()->get();
            return view('tasks.index', ['tasks' => $tasks]);
        }

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            $tasks = Auth::user()->tasks()->get();
            return view('tasks.index', ['tasks' => $tasks]);
        }

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
        ]);

        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            $tasks = Auth::user()->tasks()->get();
            return view('tasks.index', ['tasks' => $tasks]);
        }

        $task->update([
            'content' => $request->content,
            'status' => $request->status,
        ]);

        $tasks = Auth::user()->tasks()->get();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            $tasks = Auth::user()->tasks()->get();
            return view('tasks.index', ['tasks' => $tasks]);
        }

        $task->delete();

        $tasks = Auth::user()->tasks()->get();
        return view('tasks.index', ['tasks' => $tasks]);
    }
}
