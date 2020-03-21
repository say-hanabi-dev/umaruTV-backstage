<?php

namespace App\Models\Website;


use App\Models\Model;

class Danmaku extends Model
{
    protected $fillable = ['user_id', 'episode_id', 'color', 'type', 'text', 'time'];


}
