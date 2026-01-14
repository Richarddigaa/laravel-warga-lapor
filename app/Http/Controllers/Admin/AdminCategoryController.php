<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::getAllCategories();

        return view('admin.categories.category_index', compact('categories'));
    }

    public function store(CategoryStoreUpdateRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validated = $request->validated();

                $validated['slug'] = Str::slug($validated['name']);

                $newCategory = Category::create($validated);
            });

            return redirect()->route('admin.categories.index')->with('alert', [
                'title' => 'Kategori Berhasil Tersimpan',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan kategori baru:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat menambahkan kategori. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function update(CategoryStoreUpdateRequest $request, Category $category)
    {
        try {
            DB::transaction(function () use ($request, $category) {
                $validated = $request->validated();

                $validated['slug'] = Str::slug($validated['name']);

                $category->update($validated);
            });

            return redirect()->route('admin.categories.index')->with('alert', [
                'title' => 'Kategori Berhasil Diperbarui',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengubah kategori:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat mengubah kategori. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function destroy(Category $category)
    {
        try {
            DB::transaction(function () use ($category) {
                $category->delete();
            });

            return redirect()->route('admin.categories.index')->with('alert', [
                'title' => 'Kategori Berhasil Dihapus',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus kategori:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat menghapus kategori. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }
}
