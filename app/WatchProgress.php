<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchProgress extends Model
{
    protected $fillable = ['user_id', 'batch_id', 'lecture_id', 'watched_seconds', 'duration_seconds'];
}
