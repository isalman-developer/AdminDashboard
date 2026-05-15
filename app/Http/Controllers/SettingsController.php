<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Setting\SettingStoreRequest;
use App\Services\SettingService;

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
    public function store(SettingStoreRequest $request, SettingService $settingService)
    {
        $validated = $request->validated();

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
