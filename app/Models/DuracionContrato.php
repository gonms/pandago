<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuracionContrato extends Model
{
    protected $table = 'duracion_contrato';
    /* disable timestamps fields, as I don´t need them for this demo */
	public $timestamps = false;
}
