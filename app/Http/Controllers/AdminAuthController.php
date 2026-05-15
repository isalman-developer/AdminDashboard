<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Auth\UpdateProfileRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function editProfile(UserService $userService)
    {
        $user = auth()->user();
        $avatarUrl = $userService->getAuthUserAvatarUrl();

        return view('admin.profile.edit', compact('user', 'avatarUrl'));
    }

    /**
     * Update the admin profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UpdateProfileRequest $request, UserService $userService)
    {
        $validated = $request->validated();

        $userService->updateProfile($validated);

        if ($request->hasFile('avatar')) {
            $userService->updateAvatar($request->file('avatar'));
        }

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the admin profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(UserService $userService)
    {
        $user = auth()->user();
        $avatarUrl = $userService->getAuthUserAvatarUrl();

        return view('admin.profile', compact('user', 'avatarUrl'));
    }

    /**
     * Logout the admin user.
     *
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
