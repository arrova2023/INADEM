<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    ////tabla a utilizar
    public $table = 'proyecto';
    public $primaryKey = 'idProyecto';
    public $timestamps = false;
}
