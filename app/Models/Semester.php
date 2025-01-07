<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'semester', 'slug', 'semester_fee', 'staff_id', 'gradingType_id', 'major_subject_count', 'status'];


    public function faculty()
    {
        return $this->belongsToMany(Faculty::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function gradingType()
    {
        return $this->hasOne(GradingType::class, 'id','gradingType_id');
    }

    public function programNeedAcademicLevel() {
//        return $this->belongsToMany(AcademicInfoLevel::class);
        return $this->belongsToMany(AcademicInfoLevel::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class,'semesters_id','id');
    }

    public function assets()
    {
        return $this->hasMany(SemesterAsset::class,'semesters_id','id');
    }
}
