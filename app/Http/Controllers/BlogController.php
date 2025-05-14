<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blogsCategory;
use App\Models\blogs;
use App\Models\settings;
use Illuminate\Database\QueryException;  

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = blogsCategory::all();
        $blogs = blogs::with('category')->get();
        return view('admin.blogs.addblogs', compact('categories', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $validated = $request->validate([
                'title' => 'required|unique:blogs,title',
                'content' => 'required',
                'category' => 'required|exists:blog_category,id',
                'slug' => 'required|unique:blogs,slug',
                'coverImage'=> 'required|image|mimes:jpg,jpeg,png,gif,webp|max:20048',
            ]);

            $imageName = time() . '.' . $request->coverImage->extension();
            $request->coverImage->move(public_path('cover_images'), $imageName);
            $url = 'cover_images/' . $imageName;
            $blog = new blogs();
            $blog->slug = $request->input('slug');
            $blog->title = $request->input('title');
            $blog->content = $request->input('content');
            $blog->category_id = $request->input('category');
            $blog->cover_image = $url;
            $blog->created_at = now();
            $blog->updated_at = now();
            $blog->save();
            return redirect()->back()->with('success', 'blog added successfully');
        }catch(QueryException $e){
            if ($e->getcode() == 23000){
                return back()->with('error','Category with slug already exists');
            }
            return back()->with('error','Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $limit = $request->limit ? $request->limit : 9;
        $offset = $request->offset ? $request->offset : 0;

        if($request->slug){
            $data = [];
            $categories = blogsCategory::limit(5)->get();
            $blog = blogs::where('slug', $request->slug)->with('category')->first();
            $socialIcons = settings::all();
            $socialIcons = $socialIcons->map(function ($item){
                return[
                    'id' => $item->id,
                    'name' => $item->name,
                    'icon' => asset(env('APP_URL').'/'.$item->icon),
                    'url_link' => $item->url_link,
                ];
            });
            if($blog){
            $blog->cover_image = asset(env('APP_URL').'/'.$blog->cover_image);   
            $responseData = [
                'blog' => $blog,
                'categories' => $categories,
                'social'=> $socialIcons,
            ];
            $data = [
                    'success' => true,
                    'data' => $responseData,
                ];
            }else{
                $data = [
                    'success' => false,
                    'data' => null,
                    'message' => 'Blog not found'
                ];
            }
            return response()->json($data);
        }else{
            $blogs = blogs::with('category')->skip($offset)->take($limit)->get();
            $blogs = $blogs->map(function ($item){
                return $item;
            });
            $blogs = $blogs->map(function ($item){
                return[
                    'id' => $item->id,
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'created_by' => $item->admin,
                    'category' => $item->category->name,
                    'cover_image' => $item->cover_image = asset(env('APP_URL').'/'.$item->cover_image),
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });
            $data = [
                'success' => true,
                'data' => $blogs,
            ];
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = blogs::findOrFail($id);
        return view('admin.blogs.editblogs', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        try{
            $request->validate([
                'title' => 'required',
                'content' => 'required',
            ]);
            $blog = blogs::findOrFail($id);
            $blog->title = $request->input('title');
            $blog->content = $request->input('content');
            $blog->category_id = $blog->category_id; // Keep the same category
            $blog->updated_at = now();
            if($request->hasFile('coverImage')){
                $imageName = time() . '.' . $request->coverImage->extension();
                $request->coverImage->move(public_path('cover_images'), $imageName);
                $url = 'cover_images/' . $imageName;
                $blog->cover_image = $url;
            }
            $blog->save();
            return redirect()->back()->with('success', 'Blog updated successfully');
        }catch(\Exception $e){
            dd($e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the blog.'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $blog = blogs::findOrFail($id);
            $blog->delete();
            return redirect()->back()->with('success', 'Blog deleted successfully');
        }catch(\Exception $e){
            dd($e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the blog.'], 500);
        }
    }

    public function uploadImage(Request $request)
{
    $request->validate([
        'file' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
    ]);

    // Store file in "public/tinyImages"
    $file = $request->file('file');
    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('tinyImages'), $filename);

    $url = asset('tinyImages/' . $filename);

    // Store uploaded path for cleanup (optional)
    $uploadedImages = session()->get('uploaded_images', []);
    $uploadedImages[] = 'tinyImages/' . $filename;
    session()->put('uploaded_images', $uploadedImages);

    return response()->json(['location' => $url]);
}
    public function cleanupUploadedImages()
    {
    $uploadedImages = session()->get('uploaded_images', []);

    foreach ($uploadedImages as $image) {
        if (file_exists(public_path($image))) {
            unlink(public_path($image));
        }
    }

    session()->forget('uploaded_images');
    return response()->json(['message' => 'Uploaded images cleaned up successfully.']);
    }
}