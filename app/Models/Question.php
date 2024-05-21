<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question'];

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
