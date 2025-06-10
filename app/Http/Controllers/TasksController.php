<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
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

        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();

        return redirect('/');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
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
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/');
    }
}
