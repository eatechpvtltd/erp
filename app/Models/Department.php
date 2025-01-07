<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'department', 'sorting', 'status'];

    public function faculties() {
        //faculty_head
        return $this->belongsToMany(Faculty::class,'department_programs','department_id');
    }
}
