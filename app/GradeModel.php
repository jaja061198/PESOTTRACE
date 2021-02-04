<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section as SectionModel;

class GradeModel extends Model
{
    //
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
         'grade_level','status','id'
    ];


    public function getSections()
    {
    	return $this->hasMany(new SectionModel, 'id','grade_level');
    }
}
