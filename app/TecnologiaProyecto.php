<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TecnologiaProyecto extends Model
{
    ////tabla a utilizar
    public $table = 'tecnologiaproyecto';
    public $primaryKey = 'idTecnologiaProyecto';
    public $timestamps = false;
}