<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;


class ThemeController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->paginate(4);
        $sliderBlogs = Blog::latest()->take(5)->get();
        return view('theme.index',compact('blogs','sliderBlogs'));
    }
    public function category($id){
        // $categoryId = Category::where('name',$name)->first()->id;
        // $categoryName = $name;
        $categoryName = Category::find($id)->name;
        // $blogs=Blog::where('category_id',$categoryId)->paginate(8);
        $blogs=Blog::where('category_id',$id)->paginate(8);
        return view('theme.category',compact('blogs','categoryName'));
    }
    public function contact(){
        return view('theme.contact');
    }
    // public function singleBlog(){
    //     return view('theme.single-blog');
    // }
}
