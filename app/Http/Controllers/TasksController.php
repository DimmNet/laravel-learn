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
     * ������ ���� ����� ��� ������� ��������.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllTasks()
    {
        $tasks = Tasks::orderBy('complete')->paginate();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * ������ ����� ��������������� ������������
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUserTasks()
    {
        $tasks = auth()->user()->tasks()->orderBy('complete')->paginate();

        return view('tasks.index', compact('tasks'));
    }

        /**
     * ����������� ������ �� � ID.
     *
     * @param  \App\Tasks  $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Tasks $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * ����������� ����� �������� ������.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * ��������� ������.
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
     * ������� ������ ����������.
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
     * ����������� ����� �������������� ������.
     *
     * @param  \App\Tasks  $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tasks $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * ��������� ������.
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
     * �������� ������.
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
