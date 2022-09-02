<?php

namespace App\Http\Controllers;

use App\Models\SetTask;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Projact;
use App\Models\Student_model;
use App\Models\Teacher;
use App\Notifications\SendShaduleNotification;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SubmitTaskNOtification;

class SetTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $projact=Projact::with('getStudent')->get();
        $task=SetTask::with('getProject')->get();
        return view('Set_Schedule',compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projact=Projact::with('getStudent')->get();
        return view('create_newTask',compact('projact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'projact'=>'required',
            'description'=>'required',
        ]);
        $task=new SetTask;
        $task->title=$request->title;
        $task->description=$request->description;
        $task->status=$request->status;
        $task->proj_id=$request->projact;
        $task->save();
        $sender=SetTask::where(['title'=>$request->title,'proj_id'=>$request->projact])->get();
        $pid=$sender[0]->proj_id;
        $projact=Projact::where('proj_id',$pid)->get();
        $id=$projact[0]->id;
        $received=Student_model::where('id',$id)->get();
        Notification::send($received,new SendShaduleNotification($sender,$projact));
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SetTask  $setTask
     * @return \Illuminate\Http\Response
     */
    public function marked($id){
        $user=session()->get('user');
        $user->unreadNotifications->where('id',$id)->markAsRead();
        // $idd=$user->unreadNotifications[0]->data['id'];
        return redirect()->back();
        // return redirect('task/show/'.$idd);
    }
    public function show($id)
    {
        $user=session()->get('user');
        
        $title="";
        $projact_id="";
        foreach ($user->unreadNotifications as $notification)
        {
            $title=$notification->data['name'];
            $projact_id=$notification->data['id'];
        }
          $task= SetTask::where(['proj_id'=>$projact_id])->with('getProject')->get();
    //    return $task=SetTask::with('getProject')->get();
        return view('student.task_shadule',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SetTask  $setTask
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task=SetTask::findorFail($id);
        return view('edit_task',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SetTask  $setTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task=SetTask::findorFail($id);
        $request->validate([
            'title'=>'required',
        ]);

        $task->title=$request->title;
        $task->description=$request->description;
        $task->status=$request->status;
        $task->projact_id=$request->projact;
        $task->save();
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SetTask  $setTask
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo "helo";
        // die;
        $task=SetTask::findorFail($id);
        $task->delete();
        return redirect()->route('task.index');
    }
     public function openTask($id){

        $received=Teacher::all();
        $task=SetTask::findorFail($id);
        $url=url('task/save'."/".$id);
        return view('student.open_task',compact('task','url','received'));
     }
     public function submitTask($id,Request $request){
        // return $request;
        $request->validate([
            'supervisor'=>'required|integer',
            'discription'=>'required',
        ]);
        $task=SetTask::where('id',$id)->update([
            'description'=>$request->input('discription'),
            'status'=>'working'
        ]);
         $sender=SetTask::where(['id'=>$request->senderid,'proj_id'=>$request->projactid])->get();
         $pid=$sender[0]->proj_id;
        $projact=Projact::where('proj_id',$pid)->get();
        // $id=$projact[0]->id;
        $student=Student_model::where('id',$id)->get();
         $received=Teacher::where('id',$request->supervisor)->get();
         Notification::send($received,new SubmitTaskNOtification($sender));
        return redirect('task/show');
     }
}

