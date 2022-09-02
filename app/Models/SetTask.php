<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetTask extends Model
{
    use HasFactory;
    protected $table="set_tasks";
    protected $primarykey="id";

    public function getProject()
    {
        return $this->hasMany('App\Models\Projact','proj_id','proj_id');
    }
    public function getStudent(){
        return  $this->hasMany('App\Models\Student_model','id','id');
      }
    // public static function getUserNameById($id){
    //     return Projact::where('proj_id', $id)->pluck('proj_name')->first();
    // }
     
    // {{ App\Models\registration::getUserNameByID($value->user_id)}}
}
