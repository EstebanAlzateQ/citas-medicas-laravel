<?php

namespace Database\Seeders;

use App\Models\Medico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; 

class MedicoSeeder extends Seeder
{
    public function run(): void
    {
        
        Schema::disableForeignKeyConstraints();
        Medico::truncate(); 
        Schema::enableForeignKeyConstraints();

       
        Medico::create(['nombre_completo' => 'Dr. Carlos Rivera', 'especialidad' => 'Cardiología']);
        Medico::create(['nombre_completo' => 'Dra. Ana Gómez', 'especialidad' => 'Pediatría']);
        Medico::create(['nombre_completo' => 'Dr. Luis Martínez', 'especialidad' => 'Dermatología']);
        Medico::create(['nombre_completo' => 'Dra. Isabela Rojas', 'especialidad' => 'Psicología']);
    }
}
