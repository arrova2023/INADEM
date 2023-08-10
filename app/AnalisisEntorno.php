<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalisisEntorno extends Model
{
        //tabla a utilizar
    public $table = 'analisisentorno';
    public $primaryKey = 'idAnalisisEntorno';
    public $timestamps = false;
}
