<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zip extends Model
{
    // These 3 lines of code allow the use of a string as primary key other than ID.
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $keyType = ‘string’;


}
