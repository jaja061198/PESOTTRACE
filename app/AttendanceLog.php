<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ClassSetup;
use App\Student;

class AttendanceLog extends Model
{
    //

    public function getClass()
    {
        return $this->hasOne(new ClassSetup,'id','class_id')->with('getSection')->with('getGrade');
    }

    public function getStudent()
    {
        return $this->hasOne(new Student,'qr_image','student_id');
    }
    // public function getSection()
    // {
    //     return $this->hasOne(new Section,'id','section');
    // }

    // public function getGrade()
    // {
    //     return $this->hasOne(new GradeModel,'id','grade');
    // }
}


