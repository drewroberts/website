<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}