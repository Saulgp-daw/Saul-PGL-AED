<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignaturaController;
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

//ALUMNOS
Route::any("/obtenerAlumnos", [AlumnoController::class, 'obtenerAlumnos']);
Route::any("/guardarAlumno", [AlumnoController::class, 'guardarAlumno']);
Route::any("/buscarAlumno/{dni}", [AlumnoController::class, 'buscarPorDni']);
Route::any("/buscarPorNombre/{nombre}", [AlumnoController::class, 'buscarPorNombre']);
Route::any("/actualizarAlumno", [AlumnoController::class, 'actualizarAlumno']);
Route::any("/eliminarAlumno/{dni}", [AlumnoController::class, 'eliminarAlumno']);

//MATRICULAS
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
