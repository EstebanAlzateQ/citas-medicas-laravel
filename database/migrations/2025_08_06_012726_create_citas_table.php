<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('citas', function (Blueprint $table) {
        $table->id();
        $table->dateTime('fecha_hora');
        $table->string('estado')->default('Programada'); // Ej: Programada, Cancelada, Completada
        $table->text('motivo_consulta')->nullable();

        // Claves foráneas
        $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');
        $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
