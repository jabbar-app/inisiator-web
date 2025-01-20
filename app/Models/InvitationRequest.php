<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'sample_article',
        'status',
        'admin_notes',
    ];
}
