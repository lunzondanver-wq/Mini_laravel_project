@extends('layouts.app')

@section('title', 'Personal Task Manager')

@section('content')

    {{-- Header --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Personal Task Manager</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Stay organized and keep track of your work.</p>
        </div>
        <a href="{{ route('tasks.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg">
            + Add Task
        </a>
    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats cards --}}
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6">
            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $total }}</p>
            <p class="text-slate-400 dark:text-slate-500 text-sm font-medium tracking-wide mt-1">TOTAL TASKS</p>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6">
            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $pending }}</p>
            <p class="text-slate-400 dark:text-slate-500 text-sm font-medium tracking-wide mt-1">PENDING</p>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6">
            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $completed }}</p>
            <p class="text-slate-400 dark:text-slate-500 text-sm font-medium tracking-wide mt-1">COMPLETED</p>
        </div>
    </div>

    {{-- Task list --}}
    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">My Tasks</h2>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm">
        @forelse ($tasks as $task)
            <div class="flex items-center justify-between px-6 py-4 @if (!$loop->last) border-b border-slate-100 dark:border-slate-700 @endif">
                <div>
                    <div class="flex items-center gap-3">
                        <p class="font-semibold text-slate-900 dark:text-white">{{ $task->task_name }}</p>
                        <span class="text-xs font-medium px-2 py-0.5 rounded-full
                            {{ $task->status === 'Completed'
                                ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400'
                                : 'bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-400' }}">
                            {{ $task->status }}
                        </span>
                    </div>
                    @if ($task->description)
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ $task->description }}</p>
                    @endif
                    @if ($task->due_date)
                        <p class="text-slate-400 dark:text-slate-500 text-xs mt-1">Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</p>
                    @endif
                </div>

                <div class="flex items-center gap-2">
                    <form action="{{ route('tasks.toggleStatus', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="text-sm font-medium px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
                            Mark as {{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="text-sm font-medium px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                          onsubmit="return confirm('Delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-sm font-medium px-3 py-1.5 rounded-lg border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <p class="text-xl font-bold text-slate-900 dark:text-white">No tasks yet</p>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Your task list is empty. Create your first task to get started.</p>
                <a href="{{ route('tasks.create') }}"
                   class="inline-block mt-5 bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg">
                    + Create Your First Task
                </a>
            </div>
        @endforelse
    </div>

@endsection