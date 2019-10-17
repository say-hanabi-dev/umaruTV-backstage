<?php

namespace App\Models;


class Anime extends Model
{
    protected $fillable = [
        'name','status','cover','introduction','status','update_time','release_time'
    ];

    protected $filter = [
        ['name'=>'Name','field'=>'name'],
        ['name'=>'Watch','field'=>'watch','type'=>'int'],
        ['name'=>'Collection','field'=>'collection','type'=>'int'],
        ['field'=>'status'],
        ['field'=>'release_time','type'=>'time'],
        ['field'=>'created_at','type'=>'time'],
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
