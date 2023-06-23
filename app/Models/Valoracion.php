<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoracion';
    /* disable timestamps fields, as I don´t need them for this demo */
	public $timestamps = false;
}
