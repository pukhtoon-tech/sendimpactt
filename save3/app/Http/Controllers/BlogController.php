<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Blog;
use Auth;
use Illuminate\Http\Request;
use Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::paginate(10);

        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'preview' => 'mimes:jpg,webp,png,gif',
        ],
        [
            'title.required' => 'Title is required',
            'preview.mimes' => 'Invalid file format',
        ]);

        $slug = Str::slug($request->title);

        $blog = Blog::where('slug', $slug)->first();

        if ($blog == null) {
            $originate = Blog::updateOrCreate(
                [
                    'user_id' => Auth::user()->id,
                    'title' => $request->title,
                    'slug' => $slug,
                    'description' => null,
                    'thumbnail' => $request->hasFile('thumbnail') ? fileUpload($request->file('thumbnail'), 'blogs') : null,
                ]
            );
        }

        $blog = Blog::where('slug', $slug)->first();
        if ($request->status == 1) {
            $blog->status = 1;
            $blog->save();
        } else {
            $blog->status = 0;
            $blog->save();
        }

        $editor = Blog::where('id', $blog->id)->first();

        return redirect()->route('dashboard.blog.final_create', $editor->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function final_create($editor_id)
    {
        $editor = Blog::where('id', $editor_id)->first();

        return view('blog.editor', compact('editor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editor_store_update(Request $request)
    {
        $editor = Blog::where('id', $request->id)->first();
        $editor->description = $request->blocks;
        $editor->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blog.show', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'preview' => 'mimes:jpg,webp,png,gif',
        ],
        [
            'title.required' => 'Title is required',
            'preview.mimes' => 'Invalid file format',
        ]);

        $slug = Str::slug($request->title);

        $blog = Blog::where('id', $id)->first();
        $blog->title = $request->title;
        $blog->slug = $slug;
        if ($request->hasFile('thumbnail')) {
            $blog->thumbnail = fileUpload($request->file('thumbnail'), 'blogs');
        } else {
            $blog->thumbnail = $request->old_thumbnail;
        }
        if ($request->status == 1) {
            $blog->status = 1;
        } else {
            $blog->status = 0;
        }
        $blog->save();

        $editor = Blog::where('id', $id)->first();

        return redirect()->route('dashboard.blog.final_create', $editor->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        // delete blog
        $blog = Blog::where($blog->id)->first();
        $blog->delete();

        Alert::success(translate('Success'), translate('Blog deleted'));

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function frontend_index()
    {
        return view('blog.frontend.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function frontend_show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blog.frontend.show', compact('blog'));
    }
}
