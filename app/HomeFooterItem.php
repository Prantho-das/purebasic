<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeFooterItem extends Model
{
    

    protected $fillable = [
        'title', 'item_type', 'value', 'icon_class', 'order_num', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_num');
    }

    // Scope for type
    public function scopeByType($query, $type)
    {
        return $query->where('item_type', $type);
    }
}
