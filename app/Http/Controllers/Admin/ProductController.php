<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\MediaService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a paginated, searchable listing of products.
     */
    public function index(Request $request, ProductService $productService, CategoryService $categoryService): View
    {
        $search     = (string) ($request->get('search') ?? '');
        $categoryId = $request->get('category_id') ? (int) $request->get('category_id') : null;
        $products   = $productService->paginate($search, $categoryId);
        $categories = $categoryService->allOrdered();

        return view('admin.products.index', compact(
            'products',
            'search',
            'categoryId',
            'categories'
        ));
    }

    /**
     * Show the product creation form.
     */
    public function create(CategoryService $categoryService): View
    {
        $categories = $categoryService->allOrdered();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Handle a new product POST from the creation form.
     */
    public function store(ProductStoreRequest $request, ProductService $productService): RedirectResponse
    {
        try {
            $productService->create($request->validated());
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create product: ' . $e->getMessage());
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show a single product's detail view.
     */
    public function show(Product $product, ProductService $productService): View
    {
        $product = $productService->find($product->id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the product edit form.
     */
    public function edit(Product $product, CategoryService $categoryService): View
    {
        $categories = $categoryService->allOrdered();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Handle a product update PUT from the edit form.
     */
    public function update(
        ProductUpdateRequest $request,
        Product $product,
        ProductService $productService
    ): RedirectResponse {
        try {
            $productService->update($product, $request->validated());
        } catch (Throwable $e) {
            return redirect()
                ->route('admin.products.edit', $product)
                ->withInput()
                ->with('error', 'Failed to update product: ' . $e->getMessage());
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Toggle a product's active / inactive status via AJAX.
     */
    public function toggleStatus(
        Product $product,
        ProductService $productService
    ): JsonResponse {
        $product = $productService->toggleActive($product);

        return response()->json([
            'success'  => true,
            'is_active' => (bool) $product->is_active,
            'message'  => $product->is_active
                ? 'Product activated.'
                : 'Product deactivated.',
        ]);
    }

    /**
     * Soft / hard delete a product via AJAX.
     */
    public function destroy(Product $product, ProductService $productService): JsonResponse
    {
        $isDeleted = $productService->delete($product);

        if ($isDeleted) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unable to delete product. It may have existing transactions or orders.',
        ], 422);
    }
}
