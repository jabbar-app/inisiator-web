<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DareQuestion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quiz()
    {
        return $this->belongsTo(DareQuiz::class);
    }
}
