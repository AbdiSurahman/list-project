@extends('layouts.master')

@section('main')
  <div class="task-list-container">
    <h1 class="task-list-heading">Task List</h1>

    <div class="task-list-task-buttons">
        <a href="{{ route('tasks.create') }}">
          <button  class="task-list-button">
            <span class="material-icons">add</span>Add task
          </button>
        </a>
      </div>

    <div class="task-list-table-head">
      <div class="task-list-header-task-name">Task Name</div>
      <div class="task-list-header-detail">Detail</div>
      <div class="task-list-header-due-date">Due Date</div>
      <div class="task-list-header-progress">Progress</div>
      <div class="task-list-header-owner-name">Owner</div>
    </div>

    @foreach ($tasks as $index => $task)
      <div class="table-body">
        <div class="table-body-task-name">
            @if ($task->status == 'completed')
            <div class="material-icons task-progress-card-top-checked">check_circle</div>
          @else
            <form
            action="{{ route('tasks.move', ['id' => $task->id, 'status' => 'completed']) }}"
            method="POST"
            >
            @method('patch')
            @csrf
            <button style="background: 0%; border: none;">
              <div class="material-icons task-progress-card-top-check">check_circle</div>
            </button>
            </form>
          @endif
          {{ $task->name }}
        </div>
        <div class="table-body-detail"> {{ $task->detail }} </div>
        <div class="table-body-due-date"> {{ $task->due_date }} </div>
        <div class="table-body-progress">
          @switch($task->status)
            @case('in_progress')
              In Progress
              @break
            @case('in_review')
              Waiting/In Review
              @break
            @case('completed')
              Completed
              @break
            @default
              Not Started
          @endswitch
        </div>
        <div class="table-body-owner-name">{{ $task->user->name }}</div>
        <div class="table-body-links">
          @can('update', $task)
            <a href="{{ route('tasks.edit', ['id' => $task->id]) }}">Edit</a>
          @endcan
          @can('delete', $task)
            <a href="{{ route('tasks.delete', ['id' => $task->id]) }}">Delete</a>
          @endcan
        </div>
        </div>
    @endforeach
  </div>
  @endsection