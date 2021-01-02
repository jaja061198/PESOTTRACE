<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeModel extends Model
{
    //
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
         'grade_level','status','id'
    ];
}
