@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

    <a href="{{ route('tasks.index') }}" class="text-blue-600 dark:text-blue-400 text-sm font-medium">&larr; Back to tasks</a>

    <h1 class="text-2xl font-bold text-slate-900 dark:text-white mt-3 mb-6">Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Task Name</label>
            <input type="text" name="task_name" value="{{ old('task_name', $task->task_name) }}"
                   class="w-full border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg px-3 py-2">
            @error('task_name') <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg px-3 py-2">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                <select name="status" class="w-full border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg px-3 py-2">
                    <option value="Pending" @selected(old('status', $task->status) === 'Pending')>Pending</option>
                    <option value="Completed" @selected(old('status', $task->status) === 'Completed')>Completed</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Due Date</label>
                <input type="date" name="due_date"
                       value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}"
                       class="w-full border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg px-3 py-2">
            </div>
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg">
            Update Task
        </button>
    </form>

@endsection