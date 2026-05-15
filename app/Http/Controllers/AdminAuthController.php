<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.home'));
        }

        return back()->withErrors([
            'email' => ['The provided credentials do not match our records.'],
        ])->onlyInput('email');
    }

    /**
     * Show the admin profile edit form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editProfile()
    {
        $user = auth()->user();

        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the admin profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\UserService           $userService
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, UserService $userService)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'alpha_dash'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'    => 'Name is required.',
            'email.required'   => 'Email is required.',
            'email.email'      => 'Please provide a valid email address.',
            'username.alpha_dash' => 'Username may only contain letters, numbers, dashes, and underscores.',
            'password.min'     => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $userService->updateProfile($validated);

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the admin profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('admin.profile', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Logout the admin user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
