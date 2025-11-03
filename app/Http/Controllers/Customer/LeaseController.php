<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{
    public function index()
    {
        // Get all leases for the current user by email
        $leases = Tenant::where('email', Auth::user()->email)
            ->with('property')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.leases.index', compact('leases'));
    }

    public function show(Tenant $tenant)
    {
        // Verify that the lease belongs to the current user
        if ($tenant->email !== Auth::user()->email) {
            abort(403, 'Unauthorized access.');
        }

        $tenant->load('property');

        return view('customer.leases.show', compact('tenant'));
    }
}