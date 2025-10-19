<?php
// app/Models/BatchCategory.php
namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BatchCategory extends Model {
    

    protected $fillable = [
        'name', 'slug', 'description', 'type', 'parent_id', 'fee_range', 'image', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // রিলেশন: প্যারেন্ট ক্যাটাগরি
    public function parent(): BelongsTo {
        return $this->belongsTo(BatchCategory::class, 'parent_id');
    }

    // রিলেশন: চাইল্ড ক্যাটাগরি
    public function children(): HasMany {
        return $this->hasMany(BatchCategory::class, 'parent_id');
    }

    public function scopeActive($query) {
        return $query->where('status', true);
    }

    // টাইপ ফিল্টার
    public function scopeOfType($query, $type) {
        return $query->where('type', $type);
    }
}