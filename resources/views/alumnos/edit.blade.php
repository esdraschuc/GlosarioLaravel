@extends('layout/template')
@section('title', 'Registrar Alumno')
@section('contenido')
<main>
    <div class="container py-3">
        <h2>Editar Alumno (UPDATE del CRUD)</h2>

        @if($errors->any())
        <div class="alert alert-warning" role="alert">
            <!-- Datos incompletos -->
            <ul>
                @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulario de registro de los datos del alumno -->
        <form action="{{ url('alumnos/'.$alumno->id) }}" method="post">
            @method("PUT") <!-- permite la actualización de los datos -->
            @csrf 

            <div class="row mb-3">
                <label for="matricula" class="col-sm-3 col-form-label">Matrícula :</label>
                <div class="col-sm-5">
                    <input type="text" name="matricula" id="matricula" class="form-control" value="{{ $alumno->matricula }}" required>
                </div> 
            </div>

            <div class="row mb-3">
                <label for="nombre" class="col-sm-3 col-form-label">Nombre :</label>
                <div class="col-sm-5">
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $alumno->nombre }}" required>
                </div> 
            </div>

            <div class="row mb-3">
                <label for="fecha" class="col-sm-3 col-form-label">Fecha Nacimiento :</label>
                <div class="col-sm-5">
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $alumno->fechaNacimiento }}" required>
                </div> 
            </div>

            <div class="row mb-3">
                <label for="telefono" class="col-sm-3 col-form-label">Telefono :</label>
                <div class="col-sm-5">
                    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $alumno->telefono }}" required>
                </div> 
            </div>

            <div class="row mb-3">
                <label for="correo" class="col-sm-3 col-form-label">Correo Electrónico :</label>
                <div class="col-sm-5">
                    <input type="email" name="correo" id="correo" class="form-control" value="{{ $alumno->correo }}">
                </div> 
            </div>

            <div class="row mb-3">
                <label for="carrera" class="col-sm-3 col-form-label">Carrera :</label>
                <div class="col-sm-5">
                    <select name="carrera" id="carrera" required>
                        <option value="">Selecciona la carrera</option>                        
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}"
                                @if ($carrera->id == $alumno->carrera_id) {{ 'selected' }} @endif> 
                                {{ $carrera->nombre }}
                            </option> 
                        @endforeach
                    </select>
                </div> 
            </div>

            <button type="submit" class="btn btn-success btn-sm">Actualizar Alumno</button>
            <p class="mt-3">
                <a href="{{ url('alumnos') }}" class="btn btn-primary btn-sm" role="button">Regresar al menu del CRUD</a>
            </p>

        </form>
    </div>
</main>