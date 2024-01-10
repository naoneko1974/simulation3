<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;


class MypageController extends Controller
{
    public function mypage(){
        $users = User::find(Auth::user()->id);
        $items = Item::where('user_id',Auth::user()->id)->orderBy('id')->Paginate(12);
        return view('mypage',compact('users','items'));
    }

    public function purchase_list(){
        $users = User::find(Auth::user()->id);
        $items = Auth::user()->sold_items()->Paginate(12);
        return view('mypage', compact('users','items'));
    }

    public function profile(){
        $users = User::find(Auth::user()->id);
        return view('profile',compact('users'));
    }

    public function update(ProfileRequest $request){
        $user = $request->only('name');
        User::find(Auth::user()->id)->update($user);

        if (!empty($request->file('select_img'))){
            $file_name = $request->file('select_img')->getClientOriginalName();
            $request->file('select_img')->storeAs('public/', $file_name);
            $file_name = 'storage/' . $file_name;
        } else {
            $file_name = $request->img_url;
        }

        $profiles = Profile::find($request->id);
        $profiles->fill([
            'img_url' => $file_name,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        $profiles->update();
        $users = User::find(Auth::user()->id);
        $items = Item::where('user_id', Auth::user()->id)->orderBy('id')->Paginate(12);
        return view('mypage',compact('users','items'));
    }
}
