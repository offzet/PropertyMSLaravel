<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
{
    // Add this method to show all repairs
    public function index()
    {
        $user = Auth::user();
        
        $repairs = Repair::with(['property', 'tenant'])
            ->whereHas('tenant', function($query) use ($user) {
                $query->where('email', $user->email);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.repairs.index', compact('repairs'));
    }

    public function create()
    {
        $user = Auth::user();
        $tenants = Tenant::where('email', $user->email)
            ->where('status', 'active')
            ->get();
            
        return view('customer.repairs.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        // Verify the tenant belongs to the user
        $tenant = Tenant::where('id', $validated['tenant_id'])
            ->where('email', $user->email)
            ->firstOrFail();

        $repair = Repair::create([
            'property_id' => $tenant->property_id,
            'tenant_id' => $tenant->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => 'pending',
        ]);

        return redirect()->route('customer.repairs.success', $repair->id);
    }

    public function success(Repair $repair)
    {
        if ($repair->tenant->email !== Auth::user()->email) {
            abort(403);
        }
        
        return view('customer.repairs.success', compact('repair'));
    }

    // Add method to show single repair
    public function show(Repair $repair)
    {
        if ($repair->tenant->email !== Auth::user()->email) {
            abort(403);
        }
        
        return view('customer.repairs.show', compact('repair'));
    }

    public function getTenantProperties($tenantId)
    {
        $user = Auth::user();
        $tenant = Tenant::where('id', $tenantId)
            ->where('email', $user->email)
            ->firstOrFail();
            
        return response()->json([
            'property' => $tenant->property
        ]);
    }
}