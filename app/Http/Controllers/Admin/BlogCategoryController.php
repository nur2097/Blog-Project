<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Traits\FileUploadTrait;

class BlogCategoryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.blog.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.blog.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:150', 'unique:blog_categories,name'],
            'image' => ['required', 'image'],
            'description' => ['required', 'max:250'],
            'status' => ['required', 'boolean']
        ]);

        $imagePath = $this->uploadImage($request, 'image');

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->image = $imagePath;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();

        toastr()->success('Created Successfully!');

        return to_route('admin.blog-category.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.blog-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:150', 'unique:blog_categories,name,'.$id],
            'image' => ['nullable', 'image'],
            'description' => ['required', 'max:250'],
            'status' => ['required', 'boolean']
        ]);

        $imagePath = $this->uploadImage($request, 'image');

        $category = BlogCategory::findOrFail($id);
        $category->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();

        toastr()->success('Successfully Updated!');

        return to_route('admin.blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try{
            $category = BlogCategory::findOrFail($id);
            $category->delete();
            return response(['status' => 'success', 'message' => 'Successfully Deleted!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }
}
