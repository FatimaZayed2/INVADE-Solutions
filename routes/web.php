<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

////////////////// Tasks ////////////////


Route::get('tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
Route::get('create-task', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
Route::post('tasks.store', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');

Route::get('tasks.edit/{task}', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
// Route::put('tasks.update/{task}', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
Route::post('tasks/{task}', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
Route::post('tasks/{task}', [App\Http\Controllers\TaskController::class, 'updatestatus'])->name('tasks.update');

Route::delete('tasks.destroy/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('tasks/trashed', [App\Http\Controllers\TaskController::class, 'trashed'])->name('tasks.trashed');
Route::patch('tasks/{task}/restore', [App\Http\Controllers\TaskController::class, 'restore'])->name('tasks.restore');
Route::delete('tasks/{task}/forceDelete', [App\Http\Controllers\TaskController::class, 'forceDelete'])->name('tasks.forceDelete');







Route::get('/{page}', [App\Http\Controllers\AdminController::class,'index']);
