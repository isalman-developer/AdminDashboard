<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Setting\SettingStoreRequest;
use App\Services\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $settings = [
            'site_name'        => setting('site_name', config('app.name')),
            'site_email'       => setting('site_email'),
            'site_description' => setting('site_description'),
            'items_per_page'   => setting('items_per_page', config('admin.pagination_per_page')),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function store(SettingStoreRequest $request, SettingService $settingService): RedirectResponse
    {
        $validated = $request->validated();

        $settingService->setMultiple([
            'site_name'        => $validated['site_name'],
            'site_email'       => $validated['site_email'] ?? '',
            'site_description' => $validated['site_description'] ?? '',
            'items_per_page'   => (int) $validated['items_per_page'],
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings saved successfully.');
    }
}
