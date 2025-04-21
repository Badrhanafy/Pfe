<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id', 'title', 'body', 'image'];

    public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}
}
