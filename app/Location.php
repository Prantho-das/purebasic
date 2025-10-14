<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'map_link',
        'status',
        'is_homepage'
    ];

    protected $casts = [
        'is_homepage' => 'boolean',
    ];
}