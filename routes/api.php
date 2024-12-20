<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Api\TaskapiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//////////// اذا اعتمدت على كنترولر خاص ب Api الموجود في App\Http\Controllers\Api\TaskapiController///////////
Route::match(['get', 'post'], 'tasks', TaskapiController::class);
Route::match(['put', 'delete'], 'tasks/{id}', TaskapiController::class);
Route::patch('tasks/{id}/restore', [TaskapiController::class, 'restore']);
// إذا اردت  function Retrieve a list of tasks Only////////////////
Route::get('tasks', [TaskapiController::class, 'index']);





////////////// اذا اعتمد على كنترولر واحد TaskController////////

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');


Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');


Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');


Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');


Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');


Route::get('/tasks/trashed', [TaskController::class, 'trashed'])->name('tasks.trashed');


Route::patch('/tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');

Route::delete('/tasks/{task}/forceDelete', [TaskController::class, 'forceDelete'])->name('tasks.forceDelete');
