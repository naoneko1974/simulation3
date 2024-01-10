<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment($id){
        $items = Item::find($id);
        return view('comment',compact('items'));
    }

    public function comment_store(Request $request){
        $comments = New Comment();
        $comments->user_id = Auth::user()->id;
        $comments->item_id = $request->id;
        $comments->comment = $request->comment;
        $comments->save();
        return back();
    }

    public function comment_destroy($id){
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }
}
