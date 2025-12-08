<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Yajra\DataTables\Facades\DataTables;


class BlogController extends Controller
{
public function index()
{
    $blogs = Blog::all(); // fetch all blogs
    return view('backend.blogs.index', compact('blogs'));
}

    public function create()
    {
        return view('backend.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'sub_title'   => 'nullable',
            'description' => 'required',
            'order_id'    => 'nullable|numeric',

        ]);

        $data = $request->only([
            'title',
            'sub_title',
            'description',
            'order_id'
        ]);

        

        // user id (login user)
        $data['user_id'] = auth()->id();


        Blog::create($data);

    


        return redirect()->route('blog.index')->with('success', 'Blog created successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('backend.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title'       => 'required',
            'sub_title'   => 'nullable',
            'description' => 'required',
            'order_id'    => 'nullable|numeric',
            
        ]);

        $data = $request->only([
            'title',
            'sub_title',
            'description',
            'order_id'
        ]);

      

        $blog->update($data);
        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'message' => 'Blog updated successfully!']);
        }

        return redirect()->route('blog.index')->with('success', 'Blog updated successfully!');
    }

    public function delete($id)
    {
        Blog::findOrFail($id)->delete();
        
        if (request()->ajax()) {
            return response()->json(['status' => 'success', 'message' => 'Blog deleted successfully!']);
        }
        return back()->with('success', 'Blog deleted successfully!');
    }
}
