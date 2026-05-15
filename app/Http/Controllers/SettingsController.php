<?php

namespace App\Http\Controllers;

use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $settings = [
            'site_name' => setting('site_name', config('app.name')),
            'site_email' => setting('site_email'),
            'site_description' => setting('site_description'),
            'items_per_page' => setting('items_per_page', 10),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Store the settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SettingService $settingService)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_email' => ['nullable', 'email', 'max:255'],
            'site_description' => ['nullable', 'string', 'max:500'],
            'items_per_page' => ['required', 'integer', 'min:5', 'max:100'],
        ], [
            'site_name.required' => 'Site name is required.',
            'items_per_page.min' => 'Items per page must be at least 5.',
            'items_per_page.max' => 'Items per page cannot exceed 100.',
        ]);

        $settingService->setMultiple([
            'site_name' => $validated['site_name'],
            'site_email' => $validated['site_email'] ?? '',
            'site_description' => $validated['site_description'] ?? '',
            'items_per_page' => (int) $validated['items_per_page'],
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings saved successfully.');
    }
}
