<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksForm;
use App\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Список всех задач для главной страницы.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllTasks()
    {
        $tasks = Tasks::orderBy('complete')->paginate();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Список задач авторизованного пользователя
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUserTasks()
    {
        $tasks = auth()->user()->tasks()->orderBy('complete')->paginate();

        return view('tasks.index', compact('tasks'));
    }

        /**
     * Отображение задачи по её ID.
     *
     * @param  \App\Tasks  $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Tasks $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Отображение формы создания задачи.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Сохраняем задачу.
     *
     * @param TasksForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TasksForm $form)
    {
        $task = auth()->user()->tasks()->save(
            new Tasks(request()->all())
        );

        return redirect()->route('tasks.show', [$task->id, $task->clearTitle]);
    }

    /**
     * Отметка задачи выполненой.
     *
     * @param  \App\Tasks  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete(Tasks $task)
    {
        $task->update([
            'complete' => 1
        ]);

        return redirect()->route('tasks.show', [$task->id, $task->clearTitle]);
    }

    /**
     * Отображение формы редактирования задачи.
     *
     * @param  \App\Tasks  $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tasks $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Сохраняем задачу.
     *
     * @param  \App\Tasks  $task
     * @param  TasksForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tasks $task, TasksForm $form)
    {
        $task->update(request()->all());

        return redirect()->route('tasks.show', [$task->id, $task->clearTitle]);
    }

    /**
     * Удаление задачи.
     *
     * @param  \App\Tasks  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tasks $task)
    {
        $task->delete();

        return redirect()->home();
    }
}
