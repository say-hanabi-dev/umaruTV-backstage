<?php

namespace App\Models\Website;

use App\Models\Model;

class Advertising extends Model
{
    protected $table = 'advertising';

    protected $fillable = [
        'name','image','link'
    ];
}
