<div class="task-progress-column">
    <div class="task-progress-column-heading">
      <h2>{{ $title }}</h2>
      <a href="{{ route('tasks.create') }}">
        <button style="background: 0%; border:solid rgb(161, 0, 0) 3px">
          <span class="material-icons">add</span>
        </button>
    </a>
    </div>
    <div>
      @foreach ($tasks as $task)
        @include('partials.task_card', [
          'task' => $task,
          'leftStatus' => $leftStatus,
          'rightStatus' => $rightStatus,
        ])
      @endforeach
    </div>
  </div>