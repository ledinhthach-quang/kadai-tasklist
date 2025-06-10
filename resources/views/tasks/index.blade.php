@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">タスク一覧</h1>
<a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">新規作成</a>

<ul class="mt-4 space-y-2">
    @foreach ($tasks as $task)
        <li class="bg-white p-4 rounded shadow">
            {{ $task->content }}（{{ $task->status }}）
            <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-500 ml-4">詳細</a>
            <a href="{{ route('tasks.edit', $task->id) }}" class="text-green-500 ml-2">編集</a>
        </li>
    @endforeach
</ul>
@endsection
