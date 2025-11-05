<?php
// app/Http\Controllers\Admin\TenantController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Property;
use App\Models\Repair;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index(Request $request)
    {
        $query = Tenant::with('property');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('property_unit', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Property filter
        if ($request->has('property_id') && $request->property_id != '') {
            $query->where('property_id', $request->property_id);
        }

        // Sort functionality
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sort, $order);

        $tenants = $query->paginate(4)->withQueryString();
        $properties = Property::all();

        if ($request->ajax()) {
            return view('admin.tenants.partials.tenants_table', compact('tenants'))->render();
        }

        return view('admin.tenants.index', compact('tenants', 'properties'));
    }

    public function search(Request $request)
    {
        $query = Tenant::with('property');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('property_unit', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('property_id') && $request->property_id != '') {
            $query->where('property_id', $request->property_id);
        }

        $tenants = $query->paginate(4);

        return response()->json([
            'html' => view('admin.tenants.partials.tenants_table', compact('tenants'))->render(),
            'pagination' => view('admin.tenants.partials.pagination', compact('tenants'))->render()
        ]);
    }

    public function create()
    {
        $properties = Property::where('status', 'available')->get();
        return view('admin.tenants.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'nullable|string|max:20',
            'property_id' => 'required|exists:properties,id',
            'lease_start' => 'required|date',
            'lease_end' => 'required|date|after:lease_start',
            'rent_amount' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $property = Property::findOrFail($request->property_id);
        $validated['property_unit'] = $property->code . ' - ' . $property->name;

        Tenant::create($validated);

        // Update property status to rented only if tenant is active
        if ($request->status === 'active') {
            $property->update(['status' => 'rented']);
        }

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant created successfully.');
    }

    public function edit(Tenant $tenant)
    {
        $properties = Property::whereIn('status', ['available', 'rented'])->get();
        return view('admin.tenants.edit', compact('tenant', 'properties'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id,
            'phone' => 'nullable|string|max:20',
            'property_id' => 'required|exists:properties,id',
            'lease_start' => 'required|date',
            'lease_end' => 'required|date|after:lease_start',
            'rent_amount' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $property = Property::findOrFail($request->property_id);
        $validated['property_unit'] = $property->code . ' - ' . $property->name;

        // Get old property before update
        $oldProperty = $tenant->property;

        $tenant->update($validated);

        // Update property statuses
        if ($oldProperty && $oldProperty->id != $request->property_id) {
            // If tenant moved to different property, set old property to available
            $oldProperty->update(['status' => 'available']);
        }

        // Update new property status
        if ($request->status === 'active') {
            $property->update(['status' => 'rented']);
        } else {
            // If tenant is not active, set property to available
            $property->update(['status' => 'available']);
        }

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant updated successfully.');
    }

    public function destroy(Tenant $tenant)
    {
        // Delete associated repair requests first
        Repair::where('tenant_id', $tenant->id)->delete();

        // Update property status to available
        if ($tenant->property) {
            $tenant->property->update(['status' => 'available']);
        }

        $tenant->delete();

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant deleted successfully.');
    }
}
