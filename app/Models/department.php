<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class department extends Model
{
    use HasFactory;
    protected $table="department";
    protected $primarekey="dept_id";

    public function setDepNameAttribute($value)
    {
        $this->attributes['dep_name']=ucwords($value);
    }
}
