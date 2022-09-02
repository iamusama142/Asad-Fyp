<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_model;
use App\Models\department;
use App\Models\Program;
use App\Models\Session;
use App\Models\Teacher;
use App\Models\FypParposal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

use Illuminate\Support\Facades\Notification;
use App\Notifications\SendRequstNotification;
use App\Notifications\givestudentLoginaccess;


class student_registration extends Controller
{
    public function send_request(){
        $url="/send_requst";
        $teacher=Teacher::all();
        // echo "<pre>";
        // print_r($teacher);
        // die;
        return view('student.send_fyp_proposal')->with(compact('url','teacher'));
    }
    public function save_request(Request $request){
        // echo "<pre>";
        //   print_r($request->all());
        //   die;
        $proposal=new FypParposal;
        $proposal->senderId=$request['senderid'];
        $proposal->receiverId=$request['supervisor'];
        $proposal->description=$request['discription'];
        // $file=count($request['files']);
        // if($file>0){
        if($request['files']){
            if($request->hasFile('files'))
            {
                $file=$request->file('files');
                $teaser_image= time().'.'.$file->getClientOriginalExtension();
                $destinationPath=public_path('/files');
                $file->move($destinationPath,$teaser_image);
                $proposal->file=$teaser_image;
            }
        }
        $proposal->save();
            $name=Student_model::where('id',$request['senderid'])->get();
            $teacher=Teacher::where('id',$request['supervisor'])->get();
            Notification::send($teacher,new SendRequstNotification($name));

        return redirect()->back();
    }
   public function index()
   {
       $dept=department::all();
       $session=Session::all();
       $program=Program::all();
      $url="/student-register";
       return view('student')->with(compact('program','session','dept','url'));
   }
   public function store(Request $request)
   {
    //
       $request->validate(
           [
               'Student_Name'=>'required|max:255|regex:/^[a-zA-ZÑñ\s]+$/',
               'Student_Email'=>'required|email|unique:student,email,id,id|max:255|regex:/(.*)@kfueit\.edu.pk/i',
                'Student_Password'=>'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#@%]).*$/',
                'Student_Number'=>'required|unique:student,std_semster_no,id,id',
                'Student_Address'=>'required|unique:student,std_reg_no,id,id',
                'Student_Registration_No'=>'required',
                'Student_Semester_Number'=>'required',
                'Student_Image'=>'required',
                'Student_Deprtment'=>'required|integer',
                'Student_Program'=>'required|integer',
                'Student_Session'=>'required|integer',
           ]
        );
        // return $request;
       $std=new Student_model;
       $std->std_name=$request['Student_Name'];
       $std->dept_id=$request['Student_Deprtment'];
       $std->std_address=$request['Student_Address'];
       $std->std_reg_no=$request['Student_Registration_No'];
       $std->email=$request['Student_Email'];
       $std->std_phone_num=$request['Student_Number'];
       $std->std_semster_no=$request['Student_Semester_Number'];
       $std->prog_id=$request['Student_Program'];
       $std->std_session_id=$request['Student_Session'];
       $std->std_password=md5($request['Student_Password']);
       $std->std_status=0;
       if($request->hasFile('Student_Image'))
       {
           $file=$request->file('Student_Image');
           $teaser_image= time().'.'.$file->getClientOriginalExtension();
           $destinationPath=public_path('/Student');
           $file->move($destinationPath,$teaser_image);
           $std->image=$teaser_image;
       }
       $std->save();
       $name= Student_model::where(['email'=>$request['Student_Email'],'std_semster_no'=>$request['Student_Semester_Number']])->get();
        // $name=Student_model::where('id',$request['senderid'])->get();
       $teacher=Teacher::all();
       Notification::send($teacher,new givestudentLoginaccess($name));

        return redirect('/')->with('success','you are successfuly registerd!');
   }
   public function view(){
    $dept=Student_model::with('getDepartment','getprogram','getSession')->paginate();
    $titel ="All Students";
    return view('student_view')->with(compact('dept','titel'));
   }
   public function edit($id)
   {
    $std=Student_model::with('getDepartment','getprogram','getSession')->where('id',$id)->get();
    $dept=department::all();
    $session=Session::all();
    $program=Program::all();
    $url="/student-register_update"."/".$id;
    return view('student_update')->with(compact('std','url','dept','session','program'));
   }
   public function status($id,$s)
   {

    Student_model::where('id',$id)
    ->update([
        'std_status'=>$s,
    ]);
    $user=session()->get('user');
    $i=$user->unreadNotifications[0]->id;
    return redirect('markread/'.$i);
   }
   public function update(Request $request, $id)
   {
    //    return $request;
    //    die;
    $std="";
    if($request->hasFile('Student_Image'))
    {

        $file=$request->file('Student_Image');
        $teaser_image= time().'.'.$file->getClientOriginalExtension();
        $destinationPath=public_path('/Student');
        $file->move($destinationPath,$teaser_image);
        $std=$teaser_image;
    }
    Student_model::where('id',$id)
    ->update([
        'std_name'=>$request->input('std_name'),
        'dept_id'=>$request->input('std_department'),
        'std_address'=>$request->input('std_adress'),
        'std_reg_no'=>$request->input('std_reg_no'),
        'email'=>$request->input('std-email'),
        'std_phone_num'=>$request->input('std_phone_no'),
        'std_semster_no'=>$request->input('std_semes_no'),
        'prog_id'=>$request->input('std_program_name'),
        'std_session_id'=>$request->input('std_session'),
        'std_password'=>md5($request->input('std_Password')) ,
        'image'=>$std,
    ]);
    return redirect('/student-register-view');
   }
   public function delete($id)
   {
    Student_model::where('id',$id)->delete();
    return redirect()->back();
   }
}
