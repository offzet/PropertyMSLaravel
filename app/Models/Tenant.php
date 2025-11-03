<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'property_unit',
        'property_id',
        'lease_start',
        'lease_end',
        'rent_amount',
        'status',
        'notes'
    ];

    protected $casts = [
        'lease_start' => 'date',
        'lease_end' => 'date',
        'rent_amount' => 'decimal:2'
    ];
    

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('lease_end', '>=', now());
    }
}