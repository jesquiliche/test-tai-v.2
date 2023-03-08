<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\http\Controllers\Admin\BloqueController;
use App\http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\PreguntaController;
use App\Http\Controllers\Admin\UserController;

Route::get("/", [HomeController::class,'index']);

Route::resource("bloques",BloqueController::class)->names('admin.bloque');
Route::resource("users",UserController::class)->names('admin.user');



Route::get("/", [HomeController::class,'index']);



Route::resource("categorias",CategoriaController::class)->names('admin.categoria');
Route::resource("preguntas",PreguntaController::class)->names('admin.pregunta');





