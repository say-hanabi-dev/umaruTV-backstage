<?php

namespace App\Models;


class Resource extends Model
{
    protected $fillable = [
        'video_id','resource','type','resolution','ranking'
    ];

    public function episode(){
        return $this->belongsTo(Episode::class,'video_id');
    }
}
