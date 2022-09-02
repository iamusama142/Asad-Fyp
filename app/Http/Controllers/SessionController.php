<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;


class SessionController extends Controller
{
    public function index(){
        return view('session');
    }
    public function insert(Request $request){
        $request->validate([
            'Session_Name'=>'required|unique:session,ses_Name,id,ses_id',
            'start_date'=>'required|date|before:end_date',
            'end_date'=>'required|date|after:start_date'
        ]);
        $session= new session();
        $session->ses_Name=$request['Session_Name'];
        $session->start_date=$request['start_date'];
        $session->end_date=$request['end_date'];
        $session->save();
        return redirect('/session/view');
    }
    public function show(){
        $session=session::paginate(100);
        $title="Session Records";
        return view('data-tale')->with(compact('title','session'));
    }
    public function edit($id)
    {

        $session=session::where('ses_id',$id)->get();
        $url=url('/session/update'."/".$id);
        return view('update_session')->with(compact('session','url'));
    }
    public function update(Request $request,$id)
    {
        session::where('ses_id',$id)
        ->update([
            'ses_Name'=>$request->input('ses_Name'),
            'start_date'=>$request->input('start_date'),
            'end_date'=>$request->input('end_date'),
        ]);
        return redirect('/session/view');
    }
    public function delete($id)
    {
        session::where('ses_id',$id)->delete();
        return redirect()->back();
    }
    public function change_status($id ,$s)
    {

        session::where('ses_id',$id)
        ->update([
            'ses_status'=>$s
        ]);
        return redirect()->back();
    }


}
