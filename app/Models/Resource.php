<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'video_id','resource','type','resolution','ranking'
    ];
    public function episode(){
        return $this->belongsTo(Episode::class,'video_id');
    }
}
