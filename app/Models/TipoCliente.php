<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    protected $table = 'tipo_cliente';
    /* disable timestamps fields, as I don´t need them for this demo */
	public $timestamps = false;
}
