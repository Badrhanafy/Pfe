<?php

namespace App\Models;
use App\Models\Reactions;
use App\Models\Post;
use App\Models\Comments;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'phone', 'address', 'role','progilePhoto','gender','date_of_birth'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /////////////////////// Netwoork part 

    // A user can create many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
     // A user can create many comments
     public function comments()
     {
         return $this->hasMany(Comments::class);
     }
      // A user can create many reactions
    public function reactions()
    {
        return $this->hasMany(Reactions::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

   
}
