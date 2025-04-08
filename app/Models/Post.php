<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable = ['user_id', 'content', 'image'];
    protected $with = ['user', 'comments.user'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

  
}