<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatriculaController;
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

//VISTAS
Route::any("/home", [HomeController::class, 'index']);
Route::any("/gestion_alumnos", [HomeController::class, 'gestionarAlumnosView']);
Route::any("/gestion_matriculas", [HomeController::class, 'gestionarMatriculasView']);
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

Route::get("/obtenerMatriculas", [MatriculaController::class, 'obtenerMatriculas']);
Route::get("/obtenerAsignaturasDeLaMatricula/{id}", [MatriculaController::class, 'obtenerAsignaturasDeLaMatricula']);
Route::get("/guardarMatricula", [MatriculaController::class, 'guardarMatricula']);
Route::get("/buscarMatricula/{id}", [MatriculaController::class, 'buscarPorId']);
Route::get("/buscarMatriculas/{dni}", [MatriculaController::class, 'buscarPorDni']);
Route::get("/actualizarMatricula", [MatriculaController::class, 'actualizarMatricula']);
Route::get("/eliminarMatricula/{id}", [MatriculaController::class, 'eliminarMatricula']);

//ASIGNATURAS
Route::get("/obtenerAsignaturas", [AsignaturaController::class, 'obtenerAsignaturas']);
Route::get("/obtenerAsignaturas", [AsignaturaController::class, 'obtenerAsignaturas']);
Route::get("/guardarAsignatura", [AsignaturaController::class, 'guardarAsignatura']);
Route::get("/buscarAsignatura/{id}", [AsignaturaController::class, 'buscarPorId']);
Route::get("/buscarAsignaturaCurso/{nombreCurso}", [AsignaturaController::class, 'buscarPorCurso']);
Route::get("/actualizarAsignatura", [AsignaturaController::class, 'actualizarAsignatura']);
Route::get("/eliminarAsignatura/{id}", [AsignaturaController::class, 'eliminarAsignatura']);
Route::get("/obtenerMatriculasConEstaAsignatura/{id}", [AsignaturaController::class, 'obtenerMatriculasConEstaAsignatura']);
