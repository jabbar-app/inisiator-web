<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function claps()
    {
        return $this->belongsToMany(User::class, 'article_claps')
            ->withPivot('claps_count')
            ->withTimestamps();
    }

    public function stats()
    {
        return $this->hasMany(ArticleStat::class);
    }
}
