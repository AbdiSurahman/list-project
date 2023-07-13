<div class="task-progress-card">
  ...
  <div class="@if ($leftStatus) task-progress-card-left @else task-progress-card-right @endif">
    @if ($leftStatus)
      // Mengapit "button" dengan "form"
      <form
        action="{{ route('tasks.move', ['id' => $task->id, 'status' => $leftStatus]) }}" 
        method="POST"
      >
        @method('patch')
        @csrf
        <button class="material-icons">chevron_left</button>
      </form>
    @endif

    @if ($rightStatus)
      // Mengapit "button" dengan "form"
      <form
        action="{{ route('tasks.move', ['id' => $task->id, 'status' => $rightStatus]) }}"
        method="POST"
      >
        @method('patch')
        @csrf
        <button class="material-icons">chevron_right</button>
      </form>
    @endif
  </div>
</div>