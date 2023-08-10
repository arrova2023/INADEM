<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colaboracion extends Model
{
     //tabla a utilizar
    public $table = 'colaboracion';
    public $primaryKey = 'idColaboracion';
    public $timestamps = false;
}
