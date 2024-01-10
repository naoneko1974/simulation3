<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\MailRequest;
use App\Mail\SendMail;
use Mail;

class MailController extends Controller
{
    public function mail($id){
        $user = User::find($id);
        return view('mail.mail',compact('user'));
    }

    public function send(MailRequest $request){
        $data = $request->all();
        Mail::to($request->email)->send(new SendMail($data));
        return back()->with('message','メールを送信しました');
    }
}
