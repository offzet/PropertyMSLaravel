<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'message',
        'details',
        'user_id',
        'loggable_id',
        'loggable_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loggable()
    {
        return $this->morphTo();
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days))
                    ->orderBy('created_at', 'desc');
    }
}