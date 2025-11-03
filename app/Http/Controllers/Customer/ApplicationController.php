<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        // Get all applications for the current user (by email)
        $applications = Tenant::where('email', Auth::user()->email)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('customer.properties.index', compact('applications'));
    }

    public function store(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'lease_start' => 'required|date',
            'lease_end' => 'required|date|after:lease_start',
            'message' => 'nullable|string',
            'terms' => 'required|accepted',
        ]);

        // Check if property is still available
        if ($property->status !== 'available') {
            return redirect()->back()
                ->with('error', 'Sorry, this property has already been rented or sold by another customer and is waiting for admin confirmation.')
                ->withInput();
        }

        // Check if there are any pending or approved applications for this property
        $existingPropertyApplication = Tenant::where('property_id', $property->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingPropertyApplication) {
            return redirect()->back()
                ->with('error', 'Sorry, this property already has a pending or approved application from another customer and is waiting for admin confirmation.')
                ->withInput();
        }

        // Check if tenant already exists with this email
        $existingTenant = Tenant::where('email', $request->email)->first();

        if ($existingTenant) {
            return redirect()->back()
                ->with('error', 'You already have a pending or active application with this email address.')
                ->withInput();
        }

        // Create new tenant application
        Tenant::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'property_id' => $property->id,
            'property_unit' => $property->code . ' - ' . $property->name,
            'lease_start' => $request->lease_start,
            'lease_end' => $request->lease_end,
            'rent_amount' => $property->price,
            'status' => 'pending', // Changed from 'active' to 'pending' for applications
            'notes' => $request->message,
        ]);

        return redirect()->route('customer.properties.index')
            ->with('success', 'Your rental application has been submitted successfully!');
    }
}