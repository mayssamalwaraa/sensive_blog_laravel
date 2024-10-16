<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request){
        $data= $request->validated();
        Comment::create($data);
        return back()->with('commentCreateStatus','Your comment sent successfully'); 
    }
}
