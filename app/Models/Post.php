<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'image'];

    // Relationship: A post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship: A post has many reactions
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function likes()
{
    return $this->hasMany(Reaction::class)->where('type', 'like');
}

public function dislikes()
{
    return $this->hasMany(Reaction::class)->where('type', 'dislike');
}
}