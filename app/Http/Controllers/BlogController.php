<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogRequest;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        // return $this->middleware('auth')->only('create');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check()){
            $categories = Category::get();
            return view('theme.blogs.create',compact('categories'));
        }
        abort(403);
        // $categories = Category::get();
        // return view('theme.blogs.create',compact('categories'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        //upload image 
        //1-get the image
        $image = $request->image;
        //2-change the name
        $newImage = time().'-'.$image->getClientOriginalName();
        //3-move image to file public
        $image->storeAs('blogs',$newImage,'public');
        $data['image'] = $newImage;
        $data['user_id']=Auth::user()->id;
        Blog::create($data);
        return back()->with('blogCreatedStatus','Your blog added successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.single-blog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
        $categories = Category::get();
        return view('theme.blogs.edit',compact('categories','blog'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
        $data = $request->validated();
        if($request->hasFile('image')){
            //delete old image
        Storage::delete('public/blogs/$blog->image');
        
        //upload new image 
        //1-get the image
        $image = $request->image;
        //2-change the name
        $newImage = time().'-'.$image->getClientOriginalName();
        //3-move image to file public
        $image->storeAs('blogs',$newImage,'public');
        $data['image'] = $newImage;
        }
        $blog->update($data);
        return back()->with('blogUpdateStatus','Your blog updated successfully');
    }
    abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
        Storage::delete('public/blogs/$blog->image');
        $blog->delete();
        return back()->with('blogDeleteStatus','Your blog deleted successfully');


        }
        abort(403);
    }
    //blogs of user
    public function myBlogs()
    {
        if(!Auth::check()){
            abort(403);
        }
        $blogs = Blog::where('user_id',Auth::user()->id)->paginate(10);
        return view('theme.blogs.my-blogs',compact('blogs'));
    }
}
