<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllocateTeacher;
use App\Models\Teacher;
use App\Models\Student_model;

class AllocateTeacherController extends Controller
{
    public function index(){
        $teacher=Teacher::all();
        $std=Student_model::all();
        $url="AllocateTeacher";
        return view('allocateTeacher')->with(compact('teacher','std','url'));
    }
    public function insert(Request $request){
        $request->validate([
            'Tacher_Name'=>'required|integer',
            'student_name'=>'required|integer',

        ]);
        $AllocateTeacher= new AllocateTeacher();
        $AllocateTeacher->teacher_id=$request['Tacher_Name'];
        $AllocateTeacher->std_id=$request['student_name'];
        $AllocateTeacher->allocate_teacher_status=1;
        $AllocateTeacher->save();
        return redirect('/Allocate/view');
    }
    public function show(){
        $AllocateTeacher=AllocateTeacher::with('getTeacher','getStudent')->paginate();
        $titel="Allocate Teacher";
        return view('allocateTeacher_view')->with(compact('AllocateTeacher','titel'));
    }
    public function edit($id)
    {
        $teacher=Teacher::all();
        $std=Student_model::all();
        $url="/Allocate/update/".$id;
        $Allocate=AllocateTeacher::with('getTeacher','getStudent')->where('allocate_teacher_id',$id)->get();
       return view('allocateTeacher_update')->with(compact('teacher','std','url','Allocate'));
    }
    public function update($id,Request $request)
    {
        AllocateTeacher::where('allocate_teacher_id',$id)
        ->update([
            'teacher_id'=>$request->input('Tacher_Name'),
            'std_id'=>$request->input('student_name'),
        ]);
        return redirect('/Allocate/view');
    }
    public function delete($id){
        AllocateTeacher::where('allocate_teacher_id',$id)
        ->delete();
        return redirect()->back();
    }
    public function status($id,$s)
    {
        AllocateTeacher::where('allocate_teacher_id',$id)
        ->update([
            'allocate_teacher_status'=>$s
        ]);
        return redirect()->back();
    }
}
