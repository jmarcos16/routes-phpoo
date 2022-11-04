<?php

use app\controllers\UserController;
use app\routes\Route;

Route::get('/user/create', [UserController::class, 'index']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::get('/user/show/{id}/{category}/{param}', [UserController::class, 'show']);
