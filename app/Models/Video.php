<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name','ranking','info','coin','anime_id'];
    
    public function resource()
    {
    	return $this->hasMany(Resource::class,'video_id');
    }

    public function anime(){
        return $this->belongsTo(Anime::class,'anime_id');
    }
}
