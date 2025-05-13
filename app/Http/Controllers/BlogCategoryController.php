<?php

namespace App\Http\Controllers;

use App\Models\blogsCategory;

use Illuminate\Http\Request;


class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = blogsCategory::all();
        return view('admin.addcategory.addcategory', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $request->validate([
                'name'=>"required",
                'description'=>"required",
            ]);
            $category = new blogsCategory();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return redirect()->back()->with('success', 'Category added successfully');
        }catch(\Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'Error adding category: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{

        }catch(\Exception $e){
            return response()->json([
                'error' => 'Error fetching category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = blogsCategory::findOrFail($id);
        return view('admin.addcategory.editcategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'name'=>"required",
                'description'=>"required",
            ]);
            $category = blogsCategory::findOrFail($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return redirect()->back()->with('success', 'Category updated successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $category = blogsCategory::findOrFail($id);
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
}
