<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as UserModel;
use App\Section as SectionModel;
Use App\GradeModel as GradeModel;
use App\Student as StudentModel;
use App\ClassSetup as ClassSetupModel;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')
        ->with('teacher_count',UserModel::where('user_level',1)->count())
        ->with('sec_count',SectionModel::count())
        ->with('myClass',ClassSetupModel::where('adviser',Auth::user()->id)->count())
        ->with('student_count',StudentModel::count())
        ->with('grade_count',GradeModel::count());
    }
}
