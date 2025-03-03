<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCommentReply extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function comment()
    {
        return $this->belongsTo(ArticleComment::class);
    }

}
