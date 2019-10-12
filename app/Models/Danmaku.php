<?php

namespace App\Models;


class Danmaku extends Model
{
    protected $fillable = ['user_id', 'video_id', 'color', 'type', 'text', 'time'];

    
}
