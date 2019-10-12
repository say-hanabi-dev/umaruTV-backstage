<?php

namespace App\Models;


class Anime extends Model
{
    protected $fillable = [
        'name','status','cover','introduction','status','update_time','release_time'
    ];
    
    public function video()
    {
    	return $this->hasMany(Episode::class,'anime_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'anime_tags');
    }

    public function scopeWithVideo($query, bool $with)
    {
    	if ($with) {
    		return $query->with('video');
    	}else{
    		return $query;
    	}
    }
}
