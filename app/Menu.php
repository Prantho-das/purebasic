<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name', 'slug', 'menu_type', 'parent_id', 'sort_order', 'link_type',
        'custom_url', 'model_name', 'route_name', 'batch_id', 'class_id', 'book_id', 'is_active','batch_category_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function scopeActive(Builder $query)
    {
        $query->where('is_active', true);
    }

    public function scopeOfType(Builder $query, $type)
    {
        $query->where('menu_type', $type);
    }

    public function scopeRoot(Builder $query)
    {
        $query->whereNull('parent_id');
    }

    // Helper for depth (used in views)
    public function getDepthAttribute()
    {
        return $this->parent ? $this->parent->depth + 1 : 0;
    }

    // Update getUrlAttribute for specific item links
    public function getUrlAttribute()
    {
        if ($this->link_type === 'custom' && $this->custom_url) {
            return $this->custom_url;
        }

        if ($this->link_type === 'model') {
            // For specific items: Use show route with ID
            if ($this->batch_id) {
                 return url('batch_details').'/'. $this->batch_id;
            }
            if ($this->batch_category_id) {
                return url('batches/category').'/'. $this->batch_category_id;
           }
            if ($this->class_id) {
              // return route(strtolower($this->model_name) . '.show', $this->class_id);
            }
            if ($this->book_id) {
               // return route(strtolower($this->model_name) . '.show', $this->book_id);
            }
            // Fallback to index if no specific ID
            if ($this->model_name && $this->route_name) {
               return route($this->route_name);
            }
        }

        return '#';
    }

    // Optional: Relationships for the specific models (for eager loading if needed)
    public function batch()
    {
        return $this->belongsTo(Membership::class);
    }

    public function lectureSheet()  // 'class' is reserved, so use 'clazz'
    {
        return $this->belongsTo(LectureSheet::class);  // Assume your Class model is aliased as Class_
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
