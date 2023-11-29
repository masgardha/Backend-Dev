<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Delete Blog
     */
    public function deleteBlog(string $id)
    {
        Blog::findOrFail($id)->delete();
        return response()->json([
            'status' => true,
            'data' => 'remove blog success'
        ]);
    }

    /**
     * Create Blog
     */
    public function createBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'string',
            'image' => 'image|mimes:jpeg,png,webp',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
        }

        $blog = Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'create Blog success',
            'data' => $blog,
        ]);
    }

    /**
     * View all blog
     */
    public function viewsBlog()
    {
        $blog = Blog::all();
        return response()->json([
            'status' => true,
            'data' => $blog
        ]);
    }

    /**
     * View blog by id
     */
    public function viewBlog($id): JsonResponse {
        $blog = Blog::findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $blog
        ]);
    }

    /**
     * Update blog
     */
    public function UpdateBlog(Request $request, string $id): JsonResponse {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'string',
            'image' => 'sometimes|image|mimes:jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $blog = Blog::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');

            if ($blog->image) {
                Storage::disk('public')->delete('images/' . $blog->image);
            }

            $request->image = $imageName ?? null;
        }

        $blog->update($request->all());

        return response()->json([
            'status' => true,
            'data' => $blog
        ]);
    }
}
