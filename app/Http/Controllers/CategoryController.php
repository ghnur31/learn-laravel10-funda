<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;



class CategoryController extends Controller
{
    public function index()
    {
        
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|max:255|string',
            'is_active' => 'sometimes',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $path = null;
        $filename = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/category/';
            $file->move($path, $filename);
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active == true ? 1 : 0,
            'image' => $path . $filename
        ]);

        Alert::success('Success', 'Category created successfully');

        return redirect('/categories')->with('success', 'Category created successfully');
    }


    public function edit(int $id)
    {
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|max:255|string',
            'is_active' => 'sometimes',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $category = Category::findOrFail($id);

        // Inisialisasi path dan filename
        $path = $category->image ? dirname($category->image) . '/' : null;
        $filename = $category->image ? basename($category->image) : null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/category/';
            $file->move($path, $filename);

            // Hapus file gambar lama jika ada
            if ($category->image && File::exists($category->image)) {
                File::delete($category->image);
            }
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active == true ? 1 : 0,
            'image' => $path . $filename
        ]);

        Alert::success('Success Title', 'Category updated successfully');

        return redirect('/categories')->with('status', 'Category updated successfully');
    }


    public function destroy(int $id)
    {
        
        $category = Category::findOrFail($id);
        if(File::exists($category->image)){
            File::delete($category->image);
        }
        $category->delete();

        return redirect()->back()->with('status', 'Category deleted successfully');
    }
}
