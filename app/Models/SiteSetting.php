<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable =[
        "custom_html",
        "slider_image",
        "banner_image"
    ];
    use HasFactory;
}
