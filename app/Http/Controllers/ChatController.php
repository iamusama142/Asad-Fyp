<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index(){
        return view('chat');
    }
    public function insert(Request $request){
        $chat= new Chat();
        $chat->chat_message=$request['val-username'];
        $chat->sender=$request['sender'];
        $chat->reciver=$request['reciver'];
        $chat->save();
        return redirect('/chat/view');
    }
    public function show(){
        $chat=Chat::all();
        return view('table-basic')->with(compact('chat'));
        // echo"<pre>";
        // print_r($chat);
        // die;

    }
    public function edit($id){}
    public function update($id,Request $request){}
    public function delete($id){}
}
