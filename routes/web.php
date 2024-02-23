<?php
use App\Http\Controllers\AlumnoController;
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

Route::get('/', function () {
    // return view('welcome');
    // return view('/alumnos.index'); // es la página de inicio de laravel
    return redirect("alumnos");
});

// Habilitar el controlado de alumnos, con la ruta o url : localhost:xxxx/alumnos
Route::resource('/alumnos', AlumnoController::class);