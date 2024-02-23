<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Carrera;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargar  los datos de los alumnos en objeto $alumnos de la tabla
        $alumnos = Alumno::all();

        // Habilitar la vista
        return view('alumnos.index', ['alumnos' => $alumnos]); // en ruta alumnos, busca vista index
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Habilitar la vista de alumnos.create 
        // Habilitar en el SELECT los nombres de las carreras
        return view('alumnos.create', ['carreras' => Carrera::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Aqui se recuperan los datos del formulario en variable $request

        // Antes de guardar, laravel tiene reglas de validación para el formulario
        $request->validate([
            'matricula' => 'required|unique:alumnos|max:12', // campo matricula obligatoria, debe ser única, 10 caracteres maximo
            'nombre' => 'required|max:80',
            'fecha' => 'required|date',
            'telefono' => 'required',
            'correo' => 'nullable|email',
            'carrera' => 'required'
        ]);

        // Si todos los datos son corectos entonces se guarda en la tabla de la BD
        // Para guardar se integran los datos en un objeto llamado $alumno (debido a que las BD en la laravel en por ORM)
        $alumno = new Alumno();
        // (nombre del campo de la tabla) -> (name del input de la vista)
        $alumno->matricula = $request->input('matricula');
        $alumno->nombre = $request->input('nombre');
        $alumno->fechaNacimiento = $request->input('fecha');
        $alumno->telefono = $request->input('telefono');
        $alumno->correo = $request->input('correo');
        $alumno->carrera_id = $request->input('carrera');
        $alumno->save(); // Guardar registro en la BD
        // Cuando guarde, presentar un mensaje en la vista mensaje
        return view("alumnos.mensaje", ['msg' => 'Alumno registrado correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Recuperar los datos del id que se va a modificar y enviarlo a la vista edit
        $alumno = Alumno::find($id);  // buscar el id del alumno
        // ahora enviamos a la vista de edit los datos
        return view('alumnos.edit', ['alumno' => $alumno, 'carreras'=>Carrera::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Habilitar la actualización de los datos

        // Antes de guardar, laravel tiene reglas de validación para el formulario
        $request->validate([
            'matricula' => 'required|max:12|unique:alumnos,matricula,'.$id, // la matricula puede ser guardada para el mismo registro pero no para otro
            'nombre' => 'required|max:80',
            'fecha' => 'required|date',
            'telefono' => 'required',
            'correo' => 'nullable|email',
            'carrera' => 'required'
        ]);

        // localizar el registro del alumnos para actualizarlo
        // Para guardar se integran los datos en un objeto llamado $alumno (debido a que las BD en la laravel en por ORM)
        $alumno =  Alumno::find($id);
        // (nombre del campo de la tabla) -> (name del input de la vista)
        $alumno->matricula = $request->input('matricula');
        $alumno->nombre = $request->input('nombre');
        $alumno->fechaNacimiento = $request->input('fecha');
        $alumno->telefono = $request->input('telefono');
        $alumno->correo = $request->input('correo');
        $alumno->carrera_id = $request->input('carrera');
        $alumno->save(); // Guardar registro en la BD
        // Cuando guarde, presentar un mensaje en la vista mensaje
        return view("alumnos.mensaje", ['msg' => 'Alumno actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Eliminamos el alumno
        $alumno = Alumno::find($id); // Buscar alumno a eliminar
        $alumno->delete();  // elimina
        return redirect("alumnos");
    }
}
