<?php

namespace App\Models\Website;


use App\Models\Model;

class Setting extends Model
{
    protected $table = 'setting';
    //
    protected $fillable = [
        'name', 'value', 'description'
    ];

    public $timestamps = false;


}
