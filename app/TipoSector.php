<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSector extends Model
{
     //tabla a utilizar
    protected $table = 'tiposector';
    public $primaryKey = 'idSector';
    public $timestamps = false;
    
}
