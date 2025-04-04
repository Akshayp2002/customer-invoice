<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\RateLimiterHelper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        try {
            // Rate Limiting: 5 requests per minute
            if ($response = RateLimiterHelper::checkLoginRateLimit($request->input('email'))) {
                return redirect()->back()->withErrors(['email' => 'Too many login attempts. Please try again later.']);
            }
            // Attempt login
            if (!Auth::attempt($request->only('email', 'password'))) {
                return redirect()->back()->withErrors(['email' => 'Invalid credentials!'])->withInput();
            }

            // Redirect to dashboard on successful login
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['email' => 'Something went wrong!'])->withInput();
        }
    }

    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);
        try {
            // Create User
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Auto-login after registration
            Auth::login($user);

            return redirect()->route('admin.dashboard')->with('success', 'Registration successful! Welcome to your dashboard.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['email' => 'Something went wrong!'])->withInput();
        }
    }
}
