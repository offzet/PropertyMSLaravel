<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'tenant_id',
        'title',
        'description',
        'priority',
        'status',
        'completed_date',
        'cost',
        'notes'
    ];

    protected $casts = [
        'reported_date' => 'date',
        'completed_date' => 'date',
        'cost' => 'decimal:2'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUrgent($query)
    {
        return $query->where('priority', 'urgent');
    }
}