@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Задачи
                    <p style="float: right">
                        <a href="{{route('tasks.create')}}">Добавить задачу</a>
                    </p>
                </div>

                <div class="panel-body">
                    @foreach ($tasks as $task)
                        @include ('tasks.task')
                    @endforeach

                    <nav class="blog-pagination">
                        {{ $tasks->links('layouts.pagination') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
