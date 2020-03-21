<?php

namespace App\Models\Website;


use App\Models\Model;

class Anime extends Model
{
    protected $fillable = [
        'name','status','cover','introduction','status','update_time','release_time'
    ];

    protected $filter = [
        ['name'=>'Watch','field'=>'watch','type'=>'int'],
        ['name'=>'Collection','field'=>'collection','type'=>'int'],
        ['field'=>'episodes','type'=>'int'],
        ['field'=>'status'],
        ['field'=>'release_time','type'=>'time'],
        ['field'=>'created_at','type'=>'time'],
    ];

    public function episode()
    {
    	return $this->hasMany(Episode::class,'anime_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'anime_tags');
    }

    public function status(){
        $data = [
            'end'=>'完结',
            'stop'=>'暂停更新',
            'updating'=>'更新中'
        ];
        return $data[$this->status];
    }

    public function scopeSearch($q,$search){
        if (empty($search)) return $q;

        return $q->where('name','like','%'.$search.'%');
    }
}
