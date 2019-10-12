<?php

namespace App\Models;


class Tag extends Model
{
    
    public function animes()
    {
        return $this->belongsToMany(Anime::class,'anime_tags');
    }
}
