<?php


use Src\Route;


Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add('GET', '/addEmployees', [Controller\Admin::class, 'addEmployees'])
    ->middleware('auth','admin');
Route::add('GET', '/avg_age', [Controller\Site::class, 'avg_age'])
    ->middleware('auth', 'employees');
Route::add('GET', '/add_worker', [Controller\Site::class, 'add_worker'])
    ->middleware('auth', 'employees');
Route::add('GET', '/add_divisions', [Controller\Site::class, 'add_divisions'])
    ->middleware('auth', 'employees');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])
    ->middleware('auth');


