<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->simplepaginate(10);
        $data['$categories'] = $categories;
        return view('admin.category.list', compact('categories'));
       
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            // $request->session()->flash('success', 'Category added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Category added successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit()
    {
        
    }
    public function update()
    {
    }

    public function destroy()
    {
    }
}
