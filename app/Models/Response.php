<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'response'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
