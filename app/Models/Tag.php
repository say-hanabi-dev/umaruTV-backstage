<?php

namespace App\Models;


class Tag extends Model
{
    protected $fillable = ['name','type'];
    public function animes()
    {
        return $this->belongsToMany(Anime::class,'anime_tags');
    }
}
