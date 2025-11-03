<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\Repair;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Properties Data
        $totalProperties = Property::count();
        $availableProperties = Property::where('status', 'available')->count();
        
        // Tenants Data
        $totalTenants = Tenant::count();
        $activeTenants = Tenant::where('status', 'active')->count();
        
        // Repairs Data
        $pendingRepairs = Repair::where('status', 'pending')->count();
        $urgentRepairs = Repair::where('priority', 'urgent')->where('status', '!=', 'completed')->count();
        
        // Repair Status Breakdown
        $repairStatus = [
            'pending' => Repair::where('status', 'pending')->count(),
            'in_progress' => Repair::where('status', 'in_progress')->count(),
            'completed' => Repair::where('status', 'completed')->count(),
            'cancelled' => Repair::where('status', 'cancelled')->count(),
        ];
        
        // Property Types Breakdown
        $propertyTypes = Property::groupBy('type')
            ->selectRaw('type, count(*) as count')
            ->pluck('count', 'type')
            ->toArray();
        
        // Tenants with lease ending soon (within 30 days)
        $tenantsWithLeaseEnding = Tenant::where('lease_end', '<=', Carbon::now()->addDays(30))
            ->where('lease_end', '>=', Carbon::now())
            ->where('status', 'active')
            ->count();
        
        // Recent Data
        $recentRepairs = Repair::with(['property', 'tenant'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentTenants = Tenant::with('property')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProperties',
            'availableProperties',
            'totalTenants',
            'activeTenants',
            'pendingRepairs',
            'urgentRepairs',
            'repairStatus',
            'propertyTypes',
            'tenantsWithLeaseEnding',
            'recentRepairs',
            'recentTenants'
        ));
    }
}