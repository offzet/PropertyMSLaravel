<?php
// database/seeders/PropertySeeder.php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        Property::create([
            'name' => 'Modern Apartment',
            'code' => 'APT-001',
            'type' => 'apartment',
            'location' => 'Makati City',
            'price' => 25000.00,
            'status' => 'available',
            'description' => 'A modern apartment in the heart of Makati',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'area_sqm' => 45
        ]);

        Property::create([
            'name' => 'Family House',
            'code' => 'HSE-001',
            'type' => 'house',
            'location' => 'Quezon City',
            'price' => 35000.00,
            'status' => 'rented',
            'description' => 'Spacious family house in a quiet neighborhood',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area_sqm' => 120
        ]);
    }
}