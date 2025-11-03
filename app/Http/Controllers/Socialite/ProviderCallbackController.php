<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ProviderCallbackController extends Controller
{
    public function __invoke($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Check if user already exists with this email but different provider
            $existingUser = User::where('email', $socialUser->getEmail())->first();

            if ($existingUser) {
                // If user exists but with different provider, update the provider info
                $existingUser->update([
                    'provider_id' => $socialUser->getId(),
                    'provider_name' => $provider,
                    'provider_token' => $socialUser->token,
                    'provider_refresh_token' => $socialUser->refreshToken,
                ]);
                
                $user = $existingUser;
            } else {
                // Create new user if doesn't exist
                $user = User::updateOrCreate(
                    [
                        'provider_id' => $socialUser->getId(),
                        'provider_name' => $provider,
                    ],
                    [
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'username' => $this->generateUniqueUsername($socialUser),
                        'provider_token' => $socialUser->token,
                        'provider_refresh_token' => $socialUser->refreshToken,
                        'email_verified_at' => now(),
                        'password' => Hash::make(Str::random(16)), // Random password for social login
                    ]
                );
            }

            Auth::login($user);

            // Redirect based on user role
            return $this->redirectToProperPage($user);

        } catch (\Exception $e) {
            Log::error('Socialite authentication failed:', [
                'provider' => $provider,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('/login')->withErrors([
                'socialite' => 'Unable to authenticate with ' . ucfirst($provider)
            ]);
        }
    }

    private function generateUniqueUsername($socialUser)
    {
        $baseUsername = Str::slug($socialUser->getName(), '_');
        
        if (empty($baseUsername) || strlen($baseUsername) < 3) {
            $baseUsername = Str::before($socialUser->getEmail(), '@');
        }
        
        $username = $baseUsername;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . '_' . rand(1000, 9999);
        }

        return $username;
    }

    private function redirectToProperPage($user)
    {
        // Check if user is admin (you might need to adjust this based on your role system)
        if ($user->is_admin || $user->hasRole('admin')) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('customer.landing');
        }
    }
}