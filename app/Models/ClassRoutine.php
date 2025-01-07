<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends  BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'faculty_id', 'semester_id', 'subject_id', 'staff_id','room','time','sorting', 'status'];
    //
}
