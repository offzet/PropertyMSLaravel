<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'location',
        'price',
        'status',
        'description',
        'bedrooms',
        'bathrooms',
        'area_sqm',
        'image',

    ];

    protected $casts = [
        'price' => 'decimal:2',
        'area_sqm' => 'decimal:2'
    ];

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

}