<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Repair;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $properties = Property::where('status', 'available')->take(6)->get();
        
        // Get user's tenant applications and repairs if any
        $applications = Tenant::where('email', $user->email)->get();
        $repairs = Repair::whereHas('tenant', function($query) use ($user) {
            $query->where('email', $user->email);
        })->get();

        return view('customer.dashboard', compact('properties', 'applications', 'repairs'));
    }

    public function properties(Request $request)
    {
        $query = Property::where('status', 'available');
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Type filter
        if ($request->has('type') && $request->type != '' && $request->type != 'all') {
            $query->where('type', $request->type);
        }
        
        // Price range filter
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Bedrooms filter
        if ($request->has('bedrooms') && $request->bedrooms != '' && $request->bedrooms != 'any') {
            $query->where('bedrooms', $request->bedrooms);
        }
        
        // Bathrooms filter
        if ($request->has('bathrooms') && $request->bathrooms != '' && $request->bathrooms != 'any') {
            $query->where('bathrooms', $request->bathrooms);
        }

        // Sort functionality
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $properties = $query->paginate(3);
        $propertyTypes = Property::select('type')->where('status', 'available')->distinct()->pluck('type');
        
        return view('customer.properties.index', compact('properties', 'propertyTypes'));
    }

    public function showProperty(Property $property)
    {
        if ($property->status !== 'available') {
            abort(404);
        }
        
        $relatedProperties = Property::where('type', $property->type)
            ->where('id', '!=', $property->id)
            ->where('status', 'available')
            ->take(4)
            ->get();
            
        return view('customer.properties.show', compact('property', 'relatedProperties'));
    }

    // ✅ Fixed AJAX search for live updates
    public function ajaxSearch(Request $request)
    {
        $query = Property::where('status', 'available');

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('location', 'like', "%{$request->search}%")
                  ->orWhere('type', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $properties = $query->take(12)->get();

        if ($request->ajax()) {
            $html = view('customer.properties.partials.ajax_properties', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        return back();
    }
}