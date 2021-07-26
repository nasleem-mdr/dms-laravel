<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentCategory;

class DocumentCategoryController extends Controller
{
    public function create()
    {
        return view('category.create', [
            'category' => new DocumentCategory,
            'categories' => DocumentCategory::get(),
            'submit' => 'Create',
        ]);
    }

    public function store()
    {
        request()->validate([
            'category' => 'required|unique:document_categories',
        ]);

        $category = DocumentCategory::create([
            'category' => request('category'),
        ]);

        return back()->with('success', "{$category->category} has been created ");
    }

    public function edit(DocumentCategory $category)
    {
        return view('category.edit', [
            'category' => $category,
            'submit' => 'Update',
        ]);
    }

    public function update(DocumentCategory $category)
    {
        request()->validate([
            'category' => 'required|unique:document_categories',
        ]);

        $old = $category->category;

        $category->update([
            'category' => request('category'),
        ]);

        return redirect()->route('category.create')->with('success', "{$old} has been updated to {$category->category}");
    }

    public function destroy(DocumentCategory $category)
    {
        $categoryTemp = $category->category;
        $category->delete();

        return redirect()->route('category.create')->with('success', "{$categoryTemp} has been deleted");
    }
}
