<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Categories;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
Use Alert;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Blog::with('category')->get();
        $title = "Data Blog";
        return view('admin.blog.index', compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create New Blog";
        $categories = Categories::get();
        return view('admin.blog.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'writter' => auth()->user()->name
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('blog', 'public');
            $data['photo'] = $photo;
        }
        Blog::create([
        ]);
        Alert::success('Success', 'Create New Blog Success!');
        return redirect()->to('admin/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Blog::find($id);
        $categories = Categories::get();
        $title = "Edit blog";
        return view('admin.blog.edit', compact('edit', 'title', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Blog::find($id);
        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'writter' => auth()->user()->name
        ];

        if ($request->hasFile('photo')) {
            if($update->photo){
                File::delete(public_path('storage/' . $update->photo));
            }
            $photo = $request->file('photo')->store('blog', 'public');
            $data['photo'] = $photo;
        }

        $update->update($data);
        return redirect()->to('admin/blog');

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    }
    public function destroy($id)
    {
        $delete = Blog::find($id)->delete();
        File::delete(public_path('storage/' . $delete->photo));
        alert()->success('Success', 'Delete success!');
        return redirect()->to('admin/blog');
    }
}
