<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderStoreRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Services\SliderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index(Request $request, SliderService $sliderService): View
    {
        $search = (string) ($request->get('search') ?? '');
        $sliders = $sliderService->paginate($search);

        return view('admin.sliders.index', compact('sliders', 'search'));
    }

    public function create(): View
    {
        return view('admin.sliders.create');
    }

    public function store(SliderStoreRequest $request, SliderService $sliderService): RedirectResponse
    {
        $validated = $request->validated();
        $validated['status'] = $request->boolean('status');

        $sliderService->create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }


    public function edit(int $id, SliderService $sliderService): View|RedirectResponse
    {
        $slider = $sliderService->find($id);

        if (! $slider) {
            return redirect()->route('admin.sliders.index')->with('error', 'Slider not found.');
        }

        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderUpdateRequest $request, int $id, SliderService $sliderService): RedirectResponse
    {
        $slider = $sliderService->find($id);

        if (! $slider) {
            return redirect()->route('admin.sliders.index')->with('error', 'Slider not found.');
        }

        $validated = $request->validated();
        $validated['status'] = $request->boolean('status');

        $sliderService->update($slider, $validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(int $id, SliderService $sliderService): RedirectResponse
    {
        $slider = $sliderService->find($id);

        if (! $slider) {
            return redirect()->route('admin.sliders.index')->with('error', 'Slider not found.');
        }

        $isDeleted = $sliderService->delete($slider);

        if ($isDeleted) {
            return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
        }

        return redirect()->back()->with('error', 'Unable to delete slider. Please try again.');
    }
}
