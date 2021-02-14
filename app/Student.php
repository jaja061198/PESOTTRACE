<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ClassSetupDetail;

class Student extends Model
{
    ///
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
         'f_name','m_name','l_name','gender','b_day','qr_iamge','image','student_id'
    ];

    public function getClasses()
    {
        return $this->hasMany(new ClassSetupDetail, 'student_id','id');
    }
}
