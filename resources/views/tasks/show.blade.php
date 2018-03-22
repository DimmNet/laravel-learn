@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $task->title }}</div>

                    <div class="panel-body">
                        <p class="task-status">
                            <?=$task->complete ? 'Задача завершена' : 'Ожидает выполнения'?>
                        </p>
                        <p class="task-meta">
                            {{ $task->user->name }} -
                            {{ $task->created_at->diffForHumans() }}
                        </p>

                        {!! $task->body !!}

                        @can('update', $task)
                            <div class="d-flex justify-content-end">
                                @if(!$task->complete)
                                    <div class="p-2">
                                        <form action="{{route('tasks.complete', $task->id)}}" method="GET" role="form">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-info">Пометить выполненым</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif

                                <div class="p-2">
                                    <form action="{{route('tasks.edit', $task->id)}}" method="GET" role="form">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-info">Редактировать</button>
                                        </div>
                                    </form>
                                </div>
                                @endcan

                                @can('delete', $task)
                                    <div class="p-2">
                                        <form action="{{route('tasks.delete', $task->id)}}" method="POST" role="form">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-danger">Удалить</button>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection