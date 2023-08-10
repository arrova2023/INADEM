<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPropiedadIntelectual extends Model
{
     //tabla a utilizar
    protected $table = 'tipopropiedadintelectual';
    public $primaryKey = 'idTipoPropiedadIntelectual';
    public $timestamps = false;
}
