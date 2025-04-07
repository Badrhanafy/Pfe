<?php

namespace App\Models;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    // A comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Posts::class);
    }
    // A comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
