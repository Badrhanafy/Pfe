<?php

namespace App\Models;
use  App\Models\Reviews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Artisan extends Model
{
    protected $fillable = ['name', 'email', 'password', 'phone', 'address', 'profession', 'experience_years', 'bio', 'photo'];

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    ////// overall rating
    public function getAverageRatingAttribute()
{
    return $this->reviews()->avg('rating');
}

public function getReviewsCountAttribute()
{
    return $this->reviews()->count();
}
}

