<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeMenu extends Model
{

    protected $fillable = [
        'title', 'url', 'menu_type', 'parent_id', 'icon', 'order_num', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('menu_type', request('type', 'header'))->where('is_active', true)->orderBy('order_num');
    }

    public function parent()
    {
        return $this->belongsTo(HomeMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(HomeMenu::class, 'parent_id');
    }
}
