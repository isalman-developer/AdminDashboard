<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(Request $request, BrandService $brandService): View
    {
        $search = (string) ($request->get('search') ?? '');
        $brands = $brandService->paginate($search);

        return view('admin.brands.index', compact('brands', 'search'));
    }

    public function create(): View
    {
        return view('admin.brands.create');
    }

    public function store(BrandRequest $request, BrandService $brandService): RedirectResponse
    {
        $brandService->create($request->validated());

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand, BrandService $brandService, MediaService $mediaService): View
    {
        $brand = $brandService->findWithProducts($brand->id);
        $logo = $mediaService->findByType($brand, 'logo')->first();

        return view('admin.brands.show', compact('brand', 'logo'));
    }

    public function edit(Brand $brand, MediaService $mediaService): View
    {
        $brand = $brand->load('media');
        $logo = $mediaService->findByType($brand, 'logo')->first();

        return view('admin.brands.edit', compact('brand', 'logo'));
    }

    public function update(
        BrandRequest $request,
        Brand $brand,
        BrandService $brandService
    ): RedirectResponse {
        $brandService->update($brand, $request->validated());

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand, BrandService $brandService): RedirectResponse
    {
        $isBrandDeleted = $brandService->delete($brand);

        if ($isBrandDeleted) {
            return redirect()
                ->back()
                ->with('success', 'Brand deleted successfully.');
        }

        return redirect()->back()->with('error', 'Unable to delete brand. It may have associated products.');
    }
}
