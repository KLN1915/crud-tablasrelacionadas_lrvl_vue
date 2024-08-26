<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //create
    public function store(Request $request)
    {
        $task = new Task();

        $task->titulo = $request->titulo;
        $task->descripcion = $request->descripcion;
        $task->estado_completada = $request->estado_completada;
        $task->categoria_id = $request->categoria_id;

        $task->save();
    }

    //read
    public function index(Request $request)
    {
        $tareas = Task::query();
        $tareas = $tareas->get();

        return response()->json([
            'tareas' => $tareas
        ],200);
    }

    //update
    public function edit($id)
    {
        $task = Task::find($id);
        return response()->json([
            'task' => $task
        ],200);
    }

    public function update(Request $request, $id){

        $task = Task::find($id);

        $task->titulo = $request->titulo;
        $task->descripcion = $request->descripcion;
        $task->estado_completada = $request->estado_completada;
        $task->categoria_id = $request->categoria_id;

        $task->save();
    }
}
