<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riesgos extends Model
{
     //tabla a utilizar
    public $table = 'riesgo';
    public $primaryKey = 'idRiesgo';
    public $timestamps = false;

    public function TipoRiesgo() //tiporiesgo
    {
        return $this->belongsTo('App\TipoRiesgo'); // links this->id to events.course_id
    }

}
