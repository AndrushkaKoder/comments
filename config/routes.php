<?php

use Kernel\Router\Route;
use App\Controllers\IndexController;
use App\Controllers\PostController;

return [
	Route::get('/', [IndexController::class, 'index']),
	Route::get('/posts', [PostController::class, 'index']),
	Route::post('/comments/add', [PostController::class, 'add']),
	Route::post('/comments/remove', [PostController::class, 'remove']),
	Route::post('/comments/edit', [PostController::class, 'edit']),
	Route::post('/comments/answer', [PostController::class, 'answer']),
];
