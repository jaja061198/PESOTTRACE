<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GradeModel as GradeModel;
use App\Student as StudentModel;
use App\ClassSetup as ClassSetupDetailModel;

class Section extends Model
{
    //
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
         'grade_level','section','status','id'
    ];


    public function getGrade()
    {
    	return $this->belongsTo(new GradeModel, 'grade_level','id');
    }

    public function getStudents()
    {
        return $this->hasMany(new ClassSetupDetailModel, 'section','id');
    }

    
}
