<?php

use Kernel\Router\Route;
use App\Controllers\IndexController;
use App\Controllers\PostController;

return [
	Route::get('/', [IndexController::class, 'index']),
	Route::get('/post', [PostController::class, 'index'])
];
