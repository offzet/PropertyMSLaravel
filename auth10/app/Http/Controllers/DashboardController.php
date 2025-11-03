<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
 
        $currentUser = Auth::user();
        $users = User::latest()->paginate(10);
        
        $data = [
            'currentUser' => $currentUser,
            'users' => $users,
            'totalUsers' => User::count(),
            'adminCount' => User::where('user_type', 'admin')->count(),
            'userCount' => User::where('user_type', 'user')->count(),
            'newThisMonth' => User::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->count(),
        ];

        return view('dashboard', $data);
    }
    

}