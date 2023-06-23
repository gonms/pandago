<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsoVehiculo extends Model
{
    protected $table = 'uso_vehiculo';
    /* disable timestamps fields, as I don´t need them for this demo */
	public $timestamps = false;
}
