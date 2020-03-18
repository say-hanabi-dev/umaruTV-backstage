<?php

namespace App\Models;


class Setting extends Model
{
    protected $table = 'setting';
    //
    protected $fillable = [
        'name', 'value', 'description'
    ];

    public $timestamps = false;


}
