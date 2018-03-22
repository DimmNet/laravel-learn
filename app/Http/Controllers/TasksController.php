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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Tasks::orderBy('complete')->paginate();

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

        session()->flash('message', '���� ������ �������!');

        return redirect()->route('tasks.show', [$task->id, $task->clearTitle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
