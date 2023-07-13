<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{


    public function __construct()
    {
    }

    public function index()
    {
        $pageTitle = 'Task List'; // Ditambahkan
        $tasks = Task::all();
        return view('tasks.index', [
            'pageTitle' => $pageTitle, //Ditambahkan
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        $pageTitle = 'Create Task'; // Ditambahkan
    // $tasks = $this->tasks;
    return view('tasks.create', [
        'pageTitle' => $pageTitle, //Ditambahkan
    ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'due_date' => 'required',
                'status' => 'required',
            ],
            $request->all()
        );

        Task::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'data berhasil ditambah');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Task';
        $task = Task::find($id);
        return view('tasks.edit', ['pageTitle' => $pageTitle, 'task' => $task]);
    } 

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $request->validate(
            [
                'name' => 'required',
                'due_date' => 'required',
                'status' => 'required',
            ],
            $request->all()
        );

            $task->update([
                'name' => $request->name,
                'detail' => $request->detail,
                'due_date' => $request->due_date,
                'status' => $request->status,
            ]);

       
        return redirect()->route('tasks.index')->with('success edit data');
    }

    public function delete($id) 
    {
        $pageTitle = 'Delete Task';
        $task = Task::find($id);
        return view('tasks.delete', ['pageTitle' => $pageTitle, 'task' => $task]);
    }

    public function destroy($id) 
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success delete data');
    }

    public function progress()
{
    $title = 'Task Progress';

    $tasks = Task::all();

    $filteredTasks = $tasks->groupBy('status');

    $tasks = [
        Task::STATUS_NOT_STARTED => $filteredTasks->get(
            Task::STATUS_NOT_STARTED, []
        ),
        Task::STATUS_IN_PROGRESS => $filteredTasks->get(
            Task::STATUS_IN_PROGRESS, []
        ),
        Task::STATUS_IN_REVIEW => $filteredTasks->get(
            Task::STATUS_IN_REVIEW, []
        ),
        Task::STATUS_COMPLETED => $filteredTasks->get(
            Task::STATUS_COMPLETED, []
        ),
    ];

    return view('tasks.progress', [
        'pageTitle' => $title,
        'tasks' => $tasks,
    ]);
}

public function move(int $id, Request $request) 
{
    $task = Task::findOrFail($id);

    $task->update([
        'status' => $request->status,
    ]);

    return redirect()->route('tasks.progress');
}

}

