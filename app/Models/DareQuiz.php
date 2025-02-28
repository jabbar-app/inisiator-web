<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DareQuiz extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function questions()
    {
        return $this->hasMany(DareQuestion::class);
    }

    public function messages()
    {
        return $this->hasMany(DareMessage::class);
    }

    public function reactions()
    {
        return $this->hasMany(DareReaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
