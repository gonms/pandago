<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehiculo extends Model
{
	protected $table = 'vehiculo';
	/* disable timestamps fields, as I don´t need them for this demo */
	public $timestamps = false;

	
	/* vehiculo table has a One-To-Many relationship with valoracion table, so I add the method to get all vehicle's ratings */
	public function valoraciones(): HasMany
    {
        return $this->hasMany(Valoracion::class);
    }

	/* vehiculo table has a Many-To-Many relationship with requerimiento table */
	public function requerimientos(): BelongsToMany
    {
        return $this->belongsToMany(Requerimiento::class);
    }

	/* vehiculo table has an inverse One-To-Many relationship with tipo_cliente table */
	public function tipo_cliente(): BelongsTo
    {
        return $this->belongsTo(TipoCliente::class);
    }

	/* vehiculo table has an inverse One-To-Many relationship with uso_vehiculo table */
	public function uso_vehiculo(): BelongsTo
    {
        return $this->belongsTo(UsoVehiculo::class);
    }

	/* vehiculo table has an inverse One-To-Many relationship with duracion_contrato table */
	public function duracion_contrato(): BelongsTo
    {
        return $this->belongsTo(DuracionContrato::class);
    }
}
