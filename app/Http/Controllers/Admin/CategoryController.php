<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a paginated, searchable listing of categories.
     */
    public function index(Request $request, CategoryService $categoryService): View
    {
        $search = (string) ($request->get('search') ?? '');
        $categories = $categoryService->paginate($search);

        return view('admin.categories.index', compact('categories', 'search'));
    }

    /**
     * Show the category creation form.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Handle a new category POST from the creation form.
     */
    public function store(CategoryRequest $request, CategoryService $categoryService): RedirectResponse
    {
        $categoryService->create($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show a single category's detail view.
     */
    public function show(Category $category, CategoryService $categoryService): View
    {
        $category = $categoryService->findWithProducts($category->id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the category edit form.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Handle a category update PUT from the edit form.
     */
    public function update(
        CategoryRequest $request,
        Category $category,
        CategoryService $categoryService
    ): RedirectResponse {
        $categoryService->update($category, $request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Soft / hard delete a category via AJAX (JSON).
     */
    public function destroy(Category $category, CategoryService $categoryService): RedirectResponse
    {
        $isCategoryDeleted = $categoryService->delete($category);

        if ($isCategoryDeleted) {
            return redirect()->back()->with('success', 'Category deleted successfully.');
        }

        return redirect()->back()->with('error', 'Unable to delete category. It may have associated products.');
    }
}
