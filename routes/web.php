<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'show'])->name('home');
Route::post('/new-todo', [TodoController::class, 'create'])->name('new-todo');
Route::patch('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
