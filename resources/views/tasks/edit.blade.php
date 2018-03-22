@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование задачи</div>

                    <div class="panel-body">
                        <form method="POST" action="{{ route('tasks.update', $task->id) }}" role="form">
                            {{csrf_field()}}
                
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" value="{{ old('title') ?: $task->title }}">
                
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="body">Описание задачи</label>
                
                                <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" id="body" name="body">{{ old('body') ?: $task->body }}</textarea>
                
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
    </div>
@endsection