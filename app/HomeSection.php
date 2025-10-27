<?php

namespace App;

use App\Banner;
use App\Visitor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeSection extends Model
{
   

    protected $fillable = [
        'title', 'subtitle', 'description', 'section_type', 'main_image', 'dynamic_data', 'order_num', 'is_active','primary_link'
    ];

    protected $casts = [
        'dynamic_data' => 'array',
    ];

    protected $appends = ['visitor_quotes'];  // Optional, for easy access

    public function banners()
    {
        return $this->hasMany(Banner::class, 'section_id');
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'section_id');
    }

    public function getVisitorQuotesAttribute()
    {
        return $this->visitors->pluck('quote');
    }
}