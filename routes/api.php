<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//CATEGORIAS
//create
Route::post('/categorias', [CategoryController::class, 'store']);
//read
Route::get('/categorias', [CategoryController::class, 'index']);
//update(1:obtiene los datos guardados,2:guarda los nuevos datos)
Route::get('/categorias/{categoria}/editar', [CategoryController::class, 'edit']);
Route::put('/categorias/{categoria}', [CategoryController::class, 'update']);
//delete
Route::delete('/categorias/{categoria}', [CategoryController::class, 'destroy']);

//TAREAS
//create
Route::post('/tareas', [TaskController::class, 'store']);
//read(1:read general, 2:read por id)
Route::get('/tareas', [TaskController::class, 'index']);
Route::get('/tareas/{id}', [TaskController::class, 'show']);
//update(1:obtiene los datos guardados,2:guarda los nuevos datos)
Route::get('/tareas/{tarea}/editar', [TaskController::class, 'edit']);
Route::put('/tareas/{tarea}', [TaskController::class, 'update']);
//delete
Route::delete('/tareas/{tarea}', [TaskController::class, 'destroy']);