<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Setting\SettingStoreRequest;
use App\Services\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(SettingService $settingService): View
    {
        $settings = $settingService->getAdminFormSettings();

        return view('admin.settings.index', compact('settings'));
    }

    public function store(SettingStoreRequest $request, SettingService $settingService): RedirectResponse
    {
        $settingService->saveAdminFormSettings($request->validated());

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings saved successfully.');
    }
}
