<?php

namespace App\Models;


class Episode extends Model
{
    protected $fillable = ['name','ranking','info','coin','anime_id'];

    public function resource()
    {
    	return $this->hasMany(Resource::class,'episode_id');
    }

    public function anime(){
        return $this->belongsTo(Anime::class,'anime_id');
    }
}
