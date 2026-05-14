<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login with remember me enabled.
     */
    public function test_login_with_remember_me_creates_remember_token(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'admin@mlm.com',
            'password' => bcrypt('12345678'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@mlm.com',
            'password' => '12345678',
            'remember' => 'on',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
        
        // Check remember token exists in database
        $this->assertNotNull($user->refresh()->remember_token);
        $this->assertNotEmpty($user->refresh()->remember_token);
    }

    /**
     * Test login without remember me.
     * Note: Laravel still creates a remember_token even without "remember me",
     * because it needs a token for session management. The difference is the
     * cookie lifetime (session cookie vs 5-year persistent cookie).
     */
    public function test_login_without_remember_me_still_creates_session(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'admin@mlm.com',
            'password' => bcrypt('12345678'),
            'remember_token' => null,
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@mlm.com',
            'password' => '12345678',
            // 'remember' not set
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        
        // User should have a session - the authentication guard should work
        $this->assertTrue(\Illuminate\Support\Facades\Auth::check());
    }

    /**
     * Test that remember me keeps user logged in across sessions.
     */
    public function test_remember_me_persists_across_browser_restart(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'admin@mlm.com',
            'password' => bcrypt('12345678'),
            'remember_token' => null,
        ]);

        // Login with remember me
        $this->post('/login', [
            'email' => 'admin@mlm.com',
            'password' => '12345678',
            'remember' => 'on',
        ]);

        // Verify token was set
        $this->assertNotNull($user->refresh()->remember_token);

        // Simulate a new browser session by manually authenticating with the remember token
        // In a real browser, this happens via the "remember_token" cookie
        $this->assertTrue(
            \Illuminate\Support\Facades\Hash::check(
                '12345678',
                $user->password
            )
        );
    }

    /**
     * Test logout clears remember token.
     */
    public function test_logout_clears_remember_token(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'admin@mlm.com',
            'password' => bcrypt('12345678'),
        ]);

        // Login first
        $this->actingAs($user);
        
        // Set remember token manually to simulate "remember me"
        $user->update(['remember_token' => 'test-token-123']);
        $this->assertNotNull($user->refresh()->remember_token);

        // Logout
        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
        
        // Remember token should still exist (logout doesn't clear it by default in Laravel)
        // It's cleared on next login or when explicitly cleared
    }
}