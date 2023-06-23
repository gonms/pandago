<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Requerimiento extends Model
{
    protected $table = 'requerimiento';
    /* disable timestamps fields, as I don´t need them for this demo */
	public $timestamps = false;

    public function vehiculos(): BelongsToMany
    {
        return $this->belongsToMany(Vehiculo::class);
    }
}
