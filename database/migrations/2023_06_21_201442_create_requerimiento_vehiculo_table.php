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
    	Schema::create('requerimiento_vehiculo', function (Blueprint $table) {
	        $table->bigInteger('vehiculo_id')->unsigned();
        	$table->foreign('vehiculo_id')
	              ->references('id')
        	      ->on('vehiculo')->onDelete('cascade');
	        $table->bigInteger('requerimiento_id')->unsigned();
        	$table->foreign('requerimiento_id')
	              ->references('id')
        	      ->on('requerimiento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requerimiento_vehiculo');
    }
};
