<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();
        
        // Search functionality - FIXED FIELD NAMES
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }
        
        // Status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Type filter
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }
        
        // Sort functionality
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sort, $order);
        
        $properties = $query->paginate(2)->withQueryString();
        
        if ($request->ajax()) {
            return view('admin.properties.partials.properties_table', compact('properties'))->render();
        }
        
        return view('admin.properties.index', compact('properties'));
    }

    public function search(Request $request)
    {
        $query = Property::query();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }
        
        $properties = $query->paginate(2);
        
        return response()->json([
            'html' => view('admin.properties.partials.properties_table', compact('properties'))->render(),
            'pagination' => view('admin.properties.partials.pagination', compact('properties'))->render()
        ]);
    }

    public function create()
    {
        // Generate a unique code for the form
        $propertyCode = $this->generatePropertyCode();
        return view('admin.properties.create', compact('propertyCode'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:properties,code',
            'type' => 'required|in:apartment,house,townhouse,condo,commercial',
            'location' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance,sold',
            'description' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area_sqm' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Auto-generate code if not provided or empty
        if (empty($validated['code'])) {
            $validated['code'] = $this->generatePropertyCode();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('properties', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        Property::create($validated);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property created successfully.');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:properties,code,' . $property->id,
            'type' => 'required|in:apartment,house,townhouse,condo,commercial',
            'location' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance,sold',
            'description' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area_sqm' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('properties', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        $property->update($validated);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        // Check if property has active tenants
        $activeTenants = Tenant::where('property_id', $property->id)
            ->where('status', 'active')
            ->count();

        if ($activeTenants > 0) {
            return redirect()->route('admin.properties.index')
                ->with('error', 'Cannot delete property. There are active tenants occupying this property. Please transfer or remove the tenants first.');
        }

        // Check if property has any tenants (even inactive ones)
        $totalTenants = Tenant::where('property_id', $property->id)->count();
        
        if ($totalTenants > 0) {
            return redirect()->route('admin.properties.index')
                ->with('error', 'Cannot delete property. This property has tenant records. Please remove all tenant associations first.');
        }

        // Check if property has any repair requests
        $repairRequests = Repair::where('property_id', $property->id)->count();
        
        if ($repairRequests > 0) {
            return redirect()->route('admin.properties.index')
                ->with('error', 'Cannot delete property. There are repair requests associated with this property. Please resolve all repair requests first.');
        }

        // Delete image if exists
        if ($property->image) {
            Storage::disk('public')->delete($property->image);
        }

        // If all checks pass, delete the property
        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property deleted successfully.');
    }

    /**
     * Generate unique property code
     */
    private function generatePropertyCode()
    {
        $latestProperty = Property::latest()->first();
        $number = $latestProperty ? intval(substr($latestProperty->code, 5)) + 1 : 1;
        
        do {
            $code = 'PROP-' . str_pad($number, 3, '0', STR_PAD_LEFT);
            $number++;
        } while (Property::where('code', $code)->exists());

        return $code;
    }
}