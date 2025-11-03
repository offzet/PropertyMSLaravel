<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('admin.properties', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:apartment,house,townhouse,condo,commercial',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance,sold',
            'description' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area_sqm' => 'nullable|integer|min:0'
        ]);

        // Generate unique code
        $validated['code'] = $this->generatePropertyCode($validated['type']);

        Property::create($validated);

        // DIRECT REDIRECT TO PROPERTIES PAGE - GAMITIN ANG DIRECT URL
        return redirect('/properties')
            ->with('success', 'Property added successfully!');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:apartment,house,townhouse,condo,commercial',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance,sold',
            'description' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area_sqm' => 'nullable|numeric|min:0'
        ]);
        
        $property->update($validated);

        return redirect()->route('admin.properties')
            ->with('success', 'Property updated successfully!');
    }
        
    public function destroy(Property $property)
    {
        $property->delete();

        // DIRECT REDIRECT TO PROPERTIES PAGE
        return redirect('/properties')
            ->with('success', 'Property deleted successfully!');
    }

    private function generatePropertyCode($type)
    {
        $prefix = match($type) {
            'apartment' => 'APT',
            'house' => 'HSE',
            'townhouse' => 'TH',
            'condo' => 'CON',
            'commercial' => 'COM',
            default => 'PROP'
        };

        $latest = Property::where('code', 'like', $prefix . '-%')
            ->orderBy('code', 'desc')
            ->first();

        $number = $latest ? (int)Str::after($latest->code, $prefix . '-') + 1 : 1;

        return $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}