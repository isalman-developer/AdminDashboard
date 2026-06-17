<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Models\MarkedAs;
use App\Models\Product;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request, ProductService $productService, CategoryService $categoryService, BrandService $brandService): View
    {
        $search = (string) ($request->get('search') ?? '');
        $categoryId = $request->get('category_id') ? (int) $request->get('category_id') : null;
        $brandId = $request->get('brand_id') ? (int) $request->get('brand_id') : null;
        $products = $productService->paginate($search, $categoryId, $brandId);
        $categories = $categoryService->allOrdered();
        $brands = $brandService->allOrdered();

        return view('admin.products.index', compact(
            'products',
            'search',
            'categoryId',
            'brandId',
            'categories',
            'brands'
        ));
    }

    public function create(CategoryService $categoryService, BrandService $brandService): View
    {
        $categories = $categoryService->allOrdered();
        $brands = $brandService->allOrdered();
        $markedAs = MarkedAs::orderBy('id')->get();

        return view('admin.products.create', compact('categories', 'brands', 'markedAs'));
    }

    public function store(ProductStoreRequest $request, ProductService $productService): RedirectResponse
    {
        $productService->create($request->validated());

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product, ProductService $productService): View
    {
        $product = $productService->find($product->id);

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product, CategoryService $categoryService, BrandService $brandService): View
    {
        $categories = $categoryService->allOrdered();
        $brands = $brandService->allOrdered();
        $markedAs = MarkedAs::orderBy('id')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'markedAs'));
    }

    public function update(
        ProductUpdateRequest $request,
        Product $product,
        ProductService $productService
    ): RedirectResponse {
        $productService->update($product, $request->validated());

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function toggleStatus(
        Product $product,
        ProductService $productService
    ): JsonResponse {
        $product = $productService->toggleActive($product);

        return response()->json([
            'success' => true,
            'is_active' => (bool) $product->is_active,
            'message' => $product->is_active
                ? 'Product activated.'
                : 'Product deactivated.',
        ]);
    }

    public function destroy(Product $product, ProductService $productService): RedirectResponse
    {
        $isDeleted = $productService->delete($product);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Product deleted successfully.');
        }

        return redirect()->back()->with('error', 'Unable to delete product. It may have existing transactions or orders.');
    }
}
