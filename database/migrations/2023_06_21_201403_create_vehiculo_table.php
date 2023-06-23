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
       Schema::create('vehiculo', function (Blueprint $table) {
	       $table->id();
	       $table->string('nombre');
	       $table->text('descripcion');
           $table->string('imagen');
	       $table->smallInteger('autonomia');
	       $table->smallInteger('cuota');
           $table->bigInteger('tipo_cliente_id')->unsigned();
           $table->bigInteger('uso_vehiculo_id')->unsigned();
           $table->bigInteger('duracion_contrato_id')->unsigned();

           $table->foreign('tipo_cliente_id')->references('id')->on('tipo_cliente')->onDelete('cascade');
           $table->foreign('uso_vehiculo_id')->references('id')->on('uso_vehiculo')->onDelete('cascade');
           $table->foreign('duracion_contrato_id')->references('id')->on('duracion_contrato')->onDelete('cascade');
	       $table->index('autonomia');
	       $table->index('cuota');
	});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
