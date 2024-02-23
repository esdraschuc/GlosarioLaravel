<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Para que pueda usar el método DB

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los datos para llenar la tabla mediante un arreglo (array)
        $carreras = ['Ing. Software','Ing. Animación y Efectos Visuales','Lic. en Nutrición', 'Lic. en Terapia Física','Lic. en Admon. de Emp. Turísticas'];
        // Recorrer el arreglo para ingresar cada carrera en la tabla
        foreach($carreras as $carrera) {
            DB::table('carreras')->insert(['nombre' => $carrera]);
        }
    }
}
