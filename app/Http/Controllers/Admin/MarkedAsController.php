<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarkedAs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarkedAsController extends Controller
{
    public function index(): View
    {
        $markers = MarkedAs::orderBy('id')->get();

        return view('admin.markers.index', compact('markers'));
    }

    public function edit(MarkedAs $markedAs): View
    {
        return view('admin.markers.edit', compact('markedAs'));
    }

    public function update(Request $request, MarkedAs $markedAs): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', 'trim'],
        ]);

        $markedAs->update($validated);

        return redirect()
            ->route('admin.markers.index')
            ->with('success', 'Marker updated successfully.');
    }
}
