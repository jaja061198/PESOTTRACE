<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GradeModel as GradeModel;

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
}
