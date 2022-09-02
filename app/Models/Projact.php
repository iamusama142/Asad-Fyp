<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projact extends Model
{
    use HasFactory;
    protected $table="project";
    protected $primarykey="proj_id";

    public function getStudent(){
      return  $this->hasMany('App\Models\Student_model','id','id');
    }

    public function setProjNameAttribute($value)
    {
        $this->attributes['proj_name']=ucwords($value);
    }
    // public static function getUserNameById($id){
    //     return Projact::where('proj_id', $id)->pluck('proj_name')->first();
    // }   
    // {{ App\Models\registration::getUserNameByID($value->user_id)}}

}
