<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GradeModel;
use App\Section;
use App\User;
use App\ClassSetupDetail;

class ClassSetup extends Model
{
    //
    //
    public $timestamps = false;
    
    function getSection(){
    	return $this->hasOne(new Section, 'id','section');
    }

    function getGrade(){
    	return $this->hasOne(new GradeModel, 'id','grade');
    }

    function getAdviser(){
    	return $this->hasOne(new User, 'id','adviser');
    }

    function getStudents(){
        return $this->hasMany(new ClassSetupDetail,'class_id','id')->where('status','1');   
    }
}
