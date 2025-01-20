<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriterEarning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'period',
        'amount',
        'views_count',
        'rank_rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
