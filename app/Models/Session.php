<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table="session";
    protected $primarekey="ses_id";

    public function setSesNameAttribute($value)
    {
        $this->attributes['ses_Name']=ucwords($value);
    }
}
