<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title', // Generate slug based on the 'title' column
                'onUpdate' => true   // Allow slug to update if the title is updated
            ]
        ];
    }

    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
