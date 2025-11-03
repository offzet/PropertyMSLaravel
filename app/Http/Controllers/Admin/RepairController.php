<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index(Request $request)
    {
        $query = Repair::with(['property', 'tenant']);
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('property', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('tenant', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        // Status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Priority filter
        if ($request->has('priority') && $request->priority != '') {
            $query->where('priority', $request->priority);
        }
        
        // Sort by latest
        $query->orderBy('created_at', 'desc');
        
        $repairs = $query->paginate(2)->withQueryString();
        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.repairs.partials.repairs_table', compact('repairs'))->render(),
                'pagination' => view('admin.repairs.partials.pagination', compact('repairs'))->render()
            ]);
        }
        
        return view('admin.repairs.index', compact('repairs'));
    }

    public function search(Request $request)
    {
        $query = Repair::with(['property', 'tenant']);
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('property', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('tenant', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('priority') && $request->priority != '') {
            $query->where('priority', $request->priority);
        }
        
        $query->orderBy('created_at', 'desc');
        $repairs = $query->paginate(2);
        
        return response()->json([
            'html' => view('admin.repairs.partials.repairs_table', compact('repairs'))->render(),
            'pagination' => view('admin.repairs.partials.pagination', compact('repairs'))->render()
        ]);
    }

    public function create()
    {
        $properties = Property::all();
        $tenants = Tenant::all();
        return view('admin.repairs.create', compact('properties', 'tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'required|exists:tenants,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        Repair::create($validated);

        return redirect()->route('admin.repairs.index')
            ->with('success', 'Repair request created successfully.');
    }

    public function edit(Repair $repair)
    {
        $properties = Property::all();
        $tenants = Tenant::all();
        return view('admin.repairs.edit', compact('repair', 'properties', 'tenants'));
    }

    public function update(Request $request, Repair $repair)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'required|exists:tenants,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        $repair->update($validated);

        return redirect()->route('admin.repairs.index')
            ->with('success', 'Repair request updated successfully.');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();

        return redirect()->route('admin.repairs.index')
            ->with('success', 'Repair request deleted successfully.');
    }

    // New method to get tenants for a specific property
    public function getTenantsByProperty($propertyId)
    {
        $tenants = Tenant::where('property_id', $propertyId)->get();
        return response()->json($tenants);
    }

    // New method to get properties for a specific tenant
    public function getPropertiesByTenant($tenantId)
    {
        $tenant = Tenant::find($tenantId);
        if ($tenant && $tenant->property_id) {
            $properties = Property::where('id', $tenant->property_id)->get();
        } else {
            $properties = Property::all();
        }
        return response()->json($properties);
    }
}