<?php


use Src\Route;


Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');

Route::add(['GET', 'POST'], '/addEmployees', [Controller\Admin::class, 'addEmployees']);
Route::add('GET', '/add_worker', [Controller\Site::class, 'add_worker']);
Route::add('GET', '/add_divisions', [Controller\Site::class, 'add_divisions']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

