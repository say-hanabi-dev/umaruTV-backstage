<?php

namespace App\Models\Website;


use App\Models\Model;

class Tag extends Model
{
    protected $fillable = ['name','type'];
    public function animes()
    {
        return $this->belongsToMany(Anime::class,'anime_tags');
    }
}
