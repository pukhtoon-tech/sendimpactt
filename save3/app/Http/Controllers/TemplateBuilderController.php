<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\TemplateBuilder;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemplateBuilderController extends Controller
{
    public function originate()
    {
        return view('template_builder.originate');
    }

    public function originateCreate(Request $request)
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

        $originate = TemplateBuilder::where('slug', $slug)->first();

        $editor_name = $request->editor;

        if ($originate == null) {
            $originate = TemplateBuilder::updateOrCreate([
                'owner_id' => Auth::user()->id,
                'title' => $request->title,
                'slug' => $slug,
                'html' => $request->htmlWithCss,
                'css' => $request->css,
                'preview' => $request->hasFile('preview') ? fileUpload($request->file('preview'), 'preview') : null,
            ]
            );
        }

        return $this->create($originate, $editor_name);
    }

    public function create($originate, $editor_name)
    {
        if ($editor_name == 'pro') {
            return view('maildoll_editor.create', compact('originate'));
        }

        return view('template_builder.create', compact('originate'));
    }

    /**
     * edit
     */
    public function edit($id)
    {
        $template = TemplateBuilder::where('id', $id)->where('owner_id', Auth::user()->id)->first();

        return view('template_builder.edit', compact('template'));
    }

    public function editThumbnail($id)
    {
        $template = TemplateBuilder::where('id', $id)->where('owner_id', Auth::user()->id)->select('id', 'title', 'preview')->first();

        return view('template_builder.editThumbnail', compact('template'));
    }

    public function originateUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        try {
            $slug = Str::slug($request->title);
            $person = TemplateBuilder::where('slug', $slug)->get();

            if ($person->count() > 0) {
                $slug1 = $slug.($person->count() + 1);
            } else {
                $slug1 = $slug;
            }

            $originate = TemplateBuilder::where('id', $id)->first();
            $originate->title = $request->title;
            $originate->owner_id = Auth::user()->id;
            $originate->slug = $slug;

            if ($request->hasFile('preview')) {
                $originate->preview = fileUpload($request->file('preview'), 'preview');
            }

            $originate->save();

            Alert::success('success', 'Update Successfully');

            return back();
        } catch (\Throwable $th) {
            Alert::error('Whoops', 'Something went wrong');

            return back()->withErrors($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {

        //slug save
            $slug = Str::slug($request->title);
            $person = TemplateBuilder::where('slug', $slug)->get();
            if ($person->count() > 0) {
                $slug1 = $slug.($person->count() + 1);
            } else {
                $slug1 = $slug;
            }

            $page = TemplateBuilder::where('id', $id)->first();
            $page->owner_id = $request->owner_id;
            $page->title = $request->title;
            $page->slug = $slug;
            $page->html = $request->htmlWithCss;
            $page->css = $request->css;
            $page->save();

            Alert::success(translate('Updated'), translate('Email Template Updated'));

            return response()->json('success', 200);
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    //END
}
