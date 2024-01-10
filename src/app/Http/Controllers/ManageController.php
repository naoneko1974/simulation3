<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{
    public function manage(){
        $users = User::whereIn('authority',[2,3])->Paginate(5);
        $deletes = User::onlyTrashed()->Paginate(5);
        $staffs = User::where('authority', 3)->Paginate(5);
        return view('manage',compact('users','deletes','staffs'));
    }

    public function user_search(Request $request){
        $users = User::NameSearch($request->name_keyword)->whereIn('authority', [2, 3])->Paginate(5);
        $deletes = User::onlyTrashed()->Paginate(5);
        $staffs = User::NameSearch($request->name_keyword)->where('authority', 3)->Paginate(5);
        return view('manage', compact('users', 'deletes', 'staffs'));
    }

    public function introduction($id){
        $user = User::find($id);
        $user->fill([
            'introduction' => 1,
        ]);
        $user->update();
        return back()->with('user_message', $user->name . 'を招待しました');
    }

    public function authority($id){
        $user = User::find($id);

        if (($user->authority)==3){
            $authority = 2;
        } else {
            $authority = 3;
        }

        $user->fill([
            'authority' => $authority,
        ]);
        $user->update();
        return back()->with('user_message', $user->name . 'の切り替えを行いました');
    }

    public function user_destroy($id){
        $user = User::find($id);
        $user->delete();
        return back()->with('user_message', $user->name . 'を削除しました');
    }

    public function user_restoration($id){
        User::onlyTrashed()->whereId($id)->restore();
        return back()->with('delete_user_message', '復元しました');
    }

    public function user_forcedelete($id){
        User::onlyTrashed()->whereId($id)->forceDelete();
        return back()->with('delete_user_message', '完全削除しました');
    }

    public function staff_store($id){
        $user = User::find($id);
        $user->fill([
            'staff' => 1,
        ]);
        $user->update();

        $staff = New Staff();
        $staff->user_id = $id;
        $staff->shopcode = Auth::user()->id;
        $staff->save();

        return back()->with('user_message', $user->name . 'をスタッフ招待しました');
    }

    public function staff_destroy($id){
        $user = User::find($id);
        $user->fill([
            'staff' => 0,
        ]);
        $user->update();

        $staff = Staff::where('user_id',$id)->where('shopcode',Auth::user()->id)->first();
        $staff->delete();
        return back()->with('user_message', $user->name . 'を削除しました');
    }
}
