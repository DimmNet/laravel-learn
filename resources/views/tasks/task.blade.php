<div class="task-post">
    <a href="{{ route('tasks.show', [$task->id, $task->clearTitle]) }}">
        <h3 class="task-title">
            {{ $task->title }} - <?=$task->complete ? 'Завершена' : 'Ожидает'?>
        </h3>
    </a>
    <p class="task-meta">
        {{ $task->user->name }} -
        {{ $task->created_at->diffForHumans() }}
    </p>

    {!! $task->shortBody !!}
</div>