<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GradeModel;
use App\Section;
use App\User;
use App\ClassSetup;
use App\Student;

class ClassSetupDetail extends Model
{
    //
    public $timestamps = false;

    public function studentDetail()
    {
    	return $this->hasOne(new Student,'id','student_id');
    }
}
