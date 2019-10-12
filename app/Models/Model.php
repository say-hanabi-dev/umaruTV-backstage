<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
//    public function animes()
//    {
//    	return $this->belongsToMany(Animes::class,'anime_tags');
//    }

    public function scopeUpdate_filter($q,$date){
        $date = array_filter_key(
            $date,$this->fillable
        );
        return $q->update($date);
    }
}
