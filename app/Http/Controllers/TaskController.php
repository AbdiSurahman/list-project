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

    public function edit($id)
    {
        $pageTitle = 'Edit Task';
        $task = Task::find($id);
        // $task = $tasks[$id - 1];
        return view('tasks.edit', ['pageTitle' => $pageTitle, 'task' => $task]);
    } 
}

