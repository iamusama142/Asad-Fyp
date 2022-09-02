<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllocateTeacher extends Model
{
    use HasFactory;
    protected $table="allocate_teacher";
    protected $primarykey="allocate_teacher_id";

    public function getTeacher()
    {
        return $this->hasMany('App\Models\Teacher','teacher_id','teacher_id');
    }
    public function getStudent()
    {
        return $this->hasMany('App\Models\Student_model','std_id','std_id');
    }
}
