<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\UsuarioController;
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

//REGISTRO-LOGIN
Route::any("/", [UsuarioController::class, 'index']);
Route::any("/registro", [UsuarioController::class, 'registro']);
Route::post("/login", [UsuarioController::class, 'login']);
Route::get("/logout", [UsuarioController::class, 'logout']);
Route::get("/loginForm", [UsuarioController::class, 'loginView']);
//VISTAS
Route::any("/home", [HomeController::class, 'index']);
Route::any("/gestion_alumnos", [HomeController::class, 'gestionarAlumnosView']);
Route::any("/gestion_matriculas", [HomeController::class, 'gestionarMatriculasView']);
Route::get("/gestion_asignaturas", [HomeController::class, 'gestionarAsignaturasView']);
//ALUMNOS
Route::post("/agregar_alumno", [HomeController::class, 'agregarAlumno']);
Route::post("/borrar_alumno", [HomeController::class, 'borrarAlumno']);
Route::post("/actualizar_alumno", [HomeController::class, 'actualizarAlumno']);
Route::post("/buscar_alumno", [HomeController::class, 'buscarAlumno']);

//MATRICULAS
Route::post("/agregar_matricula", [HomeController::class, 'agregarMatricula']);
Route::post("/borrar_matricula", [HomeController::class, 'borrarMatricula']);
Route::post("/editar_matricula", [HomeController::class, 'editarMatricula']);
Route::post("/buscar_matricula", [HomeController::class, 'buscarMatricula']);

//ASIGNATURAS
Route::post("/agregar_asignatura", [HomeController::class, 'agregarAsignatura']);
Route::post("/borrar_asignatura", [HomeController::class, 'borrarAsignatura']);
Route::post("/editar_asignatura", [HomeController::class, 'editarAsignatura']);
Route::post("/buscar_asignatura", [HomeController::class, 'buscarAsignatura']);



