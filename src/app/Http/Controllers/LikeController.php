<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function nice(Request $request){
        $like = New Like();
        $like->user_id = Auth::user()->id;
        $like->item_id = $request->id;
        $like->save();
        return back();
    }

    public function unnice(Request $request){
        $user = Auth::user()->id;
        $like = Like::where('user_id',$user)->where('item_id',$request->id)->first();
        $like->delete();
        return back();
    }
}
