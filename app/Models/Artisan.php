<?php

namespace App\Models;
use  App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Artisan extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 
        'profession', 'experience_years', 'bio', 'photo', 'is_verified'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    protected $appends = ['rating_stars'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getRatingStarsAttribute()
    {
        $rating = round($this->average_rating);
        $stars = '';
        
        for ($i = 1; $i <= 5; $i++) {
            $stars .= $i <= $rating ? '★' : '☆';
        }
        
        return $stars;
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
