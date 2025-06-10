@extends('layouts.app')

@section('content')

<div class="prose ml-4">
    <h2 class="text-lg">id: {{ $task->id }} のタスク編集ページ</h2>
</div>

<div class="flex justify-center">
    <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="w-1/2">
        @csrf
        @method('PUT')

        <div class="form-control my-4">
            <label for="content" class="label">
                <span class="label-text">内容:</span>
            </label>
            <input type="text" name="content" class="input input-bordered w-full" value="{{ old('content', $task->content) }}">
        </div>

        <div class="form-control my-4">
            <label for="status" class="label">
                <span class="label-text">ステータス:</span>
            </label>
            <input type="text" name="status" class="input input-bordered w-full" value="{{ old('status', $task->status) }}">
        </div>

        <button type="submit" class="btn btn-primary btn-outline">更新</button>
    </form>
</div>

@endsection
