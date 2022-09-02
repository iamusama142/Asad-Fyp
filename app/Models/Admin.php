<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use HasFactory, Notifiable;
    protected $table="admin";
    protected $primarykey="admin_id";

    public function setAdminNameAttribute($value)
    {
        $this->attributes['admin_name']=ucwords($value);
    }
}
