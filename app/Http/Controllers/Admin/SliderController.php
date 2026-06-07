<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SliderService;
use Illuminate\Http\JsonResponse;
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

    public function store(Request $request, SliderService $sliderService): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'url', 'max:2048'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:4096'],
            'status' => ['boolean'],
        ]);

        $validated['status'] = $request->has('status');

        $sliderService->create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(int $id, SliderService $sliderService): View
    {
        $slider = $sliderService->find($id);

        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, int $id, SliderService $sliderService): RedirectResponse
    {
        $slider = $sliderService->find($id);

        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'url', 'max:2048'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:4096'],
            'status' => ['boolean'],
        ]);

        $validated['status'] = $request->has('status');

        $sliderService->update($slider, $validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(int $id, SliderService $sliderService): RedirectResponse
    {
        $slider = $sliderService->find($id);

        $sliderService->delete($slider);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
